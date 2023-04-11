<?php

namespace App\Services;

use App\Enums\BookingStatusEnum;
use App\Enums\InvoiceStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Http\Requests\PaymentEditRequest;
use App\Models\Invoice;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class InvoiceService
{
    public function searchInvoice(Request $request): LengthAwarePaginator
    {
        $status = $request->query('status');
        $month = $request->query('month', 0);
        $year = $request->query('year', 0);
        $room = $request->query('room', 0);
        $user = $request->query('user', 0);

        $dateNow = now();

        return Invoice::with(['user', 'payment', 'room.floor.building'])
            // Filter Status
            ->when(!empty($status), function (Builder $query) use ($status, $dateNow) {
                $query->where(function ($query) use ($status, $dateNow) {
                    // Query PENDING
                    $query->when(in_array(InvoiceStatusEnum::PENDING->value, $status), function (Builder $query) use ($dateNow) {
                        $query->orWhere(function () use ($query, $dateNow) {
                            $query->orWhereDate('due_date', '>', $dateNow);
                            $query->where('status', InvoiceStatusEnum::PENDING->value);
                        });
                    });
                    // Query OVERDUE
                    $query->when(in_array(InvoiceStatusEnum::OVERDUE->value, $status), function (Builder $query) use ($dateNow) {
                        $query->orWhere(function () use ($query, $dateNow) {
                            $query->orWhereDate('due_date', '<', $dateNow);
                            $query->where('status', InvoiceStatusEnum::PENDING->value);
                        });
                    });
                    // Query COMPLETE
                    $query->when(in_array(InvoiceStatusEnum::COMPLETE->value, $status), function (Builder $query) {
                        $query->orWhere('status', InvoiceStatusEnum::COMPLETE);
                    });
                    // Query CANCEL
                    $query->when(in_array(InvoiceStatusEnum::CANCEL->value, $status), function (Builder $query) {
                        $query->orWhere('status', InvoiceStatusEnum::CANCEL);
                    });
                });
            })
            ->when($month > 0, function (Builder $query) use ($month) {
                $query->whereMonth('cycle', $month);
            })
            ->when($year > 0, function (Builder $query) use ($year) {
                $query->whereYear('cycle', $year);
            })
            ->when($room > 0, function (Builder $query) use ($room) {
                $query->where('room_id', $room);
            })
            ->when($user > 0, function (Builder $query) use ($user) {
                $query->where('user_id', $user);
            })
            ->latest('cycle')
            ->oldest('room_id')
            ->paginate(50)
            ->withQueryString();
    }

    public function updateInvoiceStatus(PaymentEditRequest $request, string $invoiceId): bool
    {
        $invoice = Invoice::findOrFail($invoiceId);

        if (PaymentStatusEnum::from($request->status) !== PaymentStatusEnum::PENDING) {
            $invoice->payment()->latest()->update($request->validated());
        }

        if (PaymentStatusEnum::from($request->status) === PaymentStatusEnum::COMPLETE) {
            return $this->setInvoiceStatusComplete($invoice);
        }

        if (PaymentStatusEnum::from($request->status) === PaymentStatusEnum::CANCEL) {
            return $this->setInvoiceStatusPending($invoice);
        }

        return false;
    }

    public function setInvoiceStatusComplete(Invoice $invoice): bool
    {
        $invoice->status = InvoiceStatusEnum::COMPLETE;

        if ($invoice->overdue_total <= 0) {
            $invoice->overdue_total = $invoice->dynamic_overdue_total;
        }

        if ($invoice->summary <= 0) {
            $invoice->summary = $invoice->dynamic_summary;
        }

        $invoice->save();

        return true;
    }

    public function setInvoiceStatusPending(Invoice $invoice): bool
    {
        return $invoice->update([
            'status' => InvoiceStatusEnum::PENDING,
            'overdue_total' => 0,
            'summary' => 0,
        ]);
    }

    public function setInvoiceStatusCancel(Invoice $invoice): bool
    {
        $updateInvoice = $invoice->update([
            'status' => InvoiceStatusEnum::CANCEL,
        ]);

        $updatePayment = $invoice->payment()->latest()->update([
            'status' => PaymentStatusEnum::CANCEL,
        ]);

        return $updateInvoice && $updatePayment;
    }

    public function createInvoice(string $roomId, string $cycle): Invoice
    {
        $room = Room::findOrFail($roomId);

        $configuration = $room->configuration()->first();

        $cycleParse = Carbon::parse($cycle)->setDay(1);

        $booking = $room->bookings()
            ->where('status', BookingStatusEnum::ACTIVE)
            ->latest('id')
            ->first();

        $currentUtilExpense = $room->utilityExpenses()
            ->whereMonth('cycle', $cycleParse->month)
            ->whereYear('cycle', $cycleParse->year)
            ->latest('cycle')
            ->first();

        $lastUtilExpense = $room->utilityExpenses()
            ->whereDate('cycle', '<', $cycleParse)
            ->latest('cycle')
            ->first();

        $currentUseElectricUnit = $currentUtilExpense->electric_unit ?? 0;
        $lastUseElectricUnit = $lastUtilExpense->electric_unit ?? 0;

        $currentUseWaterUnit = $currentUtilExpense->water_unit ?? 0;
        $lastUseWaterUnit = $lastUtilExpense->water_unit ?? 0;

        $electricUnitDiff = $currentUseElectricUnit - $lastUseElectricUnit;
        $waterUnitDiff = $currentUseWaterUnit - $lastUseWaterUnit;

        $electricUnitFee = $configuration->electric_fee;
        $waterUnitFee = $configuration->water_fee;

        $dueDate = $cycleParse->addMonth()->setDay(config('custom.due_date'));
        $lastDate = Carbon::parse($dueDate->toString())->addDays(config('custom.pay_within_day'));

        return Invoice::create([
            'user_id' => $booking->user_id,
            'booking_id' => $booking->id,
            'room_id' => $room->id,
            'util_expense_id' => $currentUtilExpense->id,
            'cycle' => $cycle,
            'status' => InvoiceStatusEnum::PENDING,
            'rent_total' => $configuration->rent_fee,
            'electric_unit_last' => $lastUseElectricUnit, // จดไฟครั้งก่อน
            'electric_unit_later' => $currentUseElectricUnit, // จดไฟครั้งหลัง
            'electric_unit' => $electricUnitDiff, // หน่วยที่ใช้
            'electric_unit_price' => $electricUnitFee, // ราคาไฟต่อหน่วย
            'electric_total' => $electricUnitDiff * $configuration->electric_fee * 2, // รวมค่าไฟ
            'water_unit_last' => $lastUseWaterUnit, // จดน้ำครั้งก่อน
            'water_unit_later' => $currentUseWaterUnit, // จดน้ำครั้งหลัง
            'water_unit' => $waterUnitDiff, // หน่วยที่ใช้
            'water_unit_price' => $waterUnitFee, // ราคาน้ำต่อหน่วย
            'water_total' => $waterUnitDiff * $waterUnitFee * 2, // รวมค่าน้ำ
            'parking_total' => $booking->parking_amount * $configuration->parking_fee,
            'common_total' => $configuration->common_fee,
            'due_date' => $dueDate,
            'last_date' => $lastDate,
        ]);
    }
}
