<?php

namespace App\Services;

use App\Enums\InvoiceStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Http\Requests\PaymentEditRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceService
{

    /**
     * @param Request $request
     * @return Invoice[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator|\LaravelIdea\Helper\App\Models\_IH_Invoice_C
     */
    public function searchInvoice(Request $request)
    {
        $status = $request->query('status', InvoiceStatusEnum::cases());
        $month = $request->query('month', 0);
        $year = $request->query('year', 0);
        $room = $request->query('room', 0);
        $user = $request->query('user', 0);

        return Invoice::with(['user', 'payments', 'room.floor.building'])
            ->whereIn('status', $status)
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

    /**
     * @param PaymentEditRequest $request
     * @param $invoiceId
     * @return bool
     */
    public function updateInvoiceStatus(PaymentEditRequest $request, $invoiceId): bool
    {
        if (PaymentStatusEnum::from($request->status) == PaymentStatusEnum::COMPLETE) {
            return $this->setInvoiceStatusSuccess($invoiceId);
        }

        if (PaymentStatusEnum::from($request->status) == PaymentStatusEnum::CANCEL) {
            return $this->setInvoiceStatusCancel($invoiceId);
        }

        return false;
    }

    /**
     * @param $invoiceId
     * @return true
     */
    public function setInvoiceStatusSuccess($invoiceId): bool
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

    /**
     * @param $invoiceId
     * @return true
     */
    public function setInvoiceStatusCancel($invoiceId): bool
    {
        $invoice = Invoice::findOrFail($invoiceId);

        $invoice->status = InvoiceStatusEnum::COMPLETE;
        $invoice->overdue_total = 0;
        $invoice->summary = 0;

        $invoice->save();

        return true;
    }

}
