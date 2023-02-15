<?php

namespace App\Services;

use App\Enums\InvoiceStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Http\Requests\PaymentEditRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class InvoiceService
{

    public function searchInvoice(Request $request): LengthAwarePaginator
    {
        $status = $request->query('status', InvoiceStatusEnum::cases());
        $month = $request->query('month', 0);
        $year = $request->query('year', 0);
        $room = $request->query('room', 0);
        $user = $request->query('user', 0);

        $dateNow = now();

        return Invoice::with(['user', 'payments', 'room.floor.building'])
            // Filter all status except OVERDUE
            ->orWhere(function ($query) use ($status, $dateNow) {
                $query->WhereIn('status', $status)
                    ->whereDate('due_date', '>', $dateNow);
            })
            // Filter OVERDUE
            ->when(in_array(InvoiceStatusEnum::OVERDUE->value, $status), function ($query) use ($status, $dateNow) {
                $query->orWhere('status', InvoiceStatusEnum::PENDING->value)
                    ->whereDate('due_date', '<', $dateNow);
            })
            ->when($month > 0, function ($query) use ($month) {
                $query->whereMonth('cycle', $month);
            })
            ->when($year > 0, function ($query) use ($year) {
                $query->whereYear('cycle', $year);
            })
            ->when($room > 0, function ($query) use ($room) {
                $query->where('room_id', $room);
            })
            ->when($user > 0, function ($query) use ($user) {
                $query->where('user_id', $user);
            })
            ->latest('id')
            ->paginate(40);
    }

    public function updateInvoiceStatus(PaymentEditRequest $request, string $invoiceId): bool
    {
        if (PaymentStatusEnum::from($request->status) == PaymentStatusEnum::COMPLETE) {
            return $this->setInvoiceStatusSuccess($invoiceId);
        }

        if (PaymentStatusEnum::from($request->status) == PaymentStatusEnum::CANCEL) {
            return $this->setInvoiceStatusCancel($invoiceId);
        }

        return false;
    }

    public function setInvoiceStatusSuccess(string $invoiceId): bool
    {
        $invoice = Invoice::findOrFail($invoiceId);

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

    public function setInvoiceStatusCancel(string $invoiceId): bool
    {
        $invoice = Invoice::findOrFail($invoiceId);

        $invoice->status = InvoiceStatusEnum::COMPLETE;
        $invoice->overdue_total = 0;
        $invoice->summary = 0;

        $invoice->save();

        return true;
    }

}
