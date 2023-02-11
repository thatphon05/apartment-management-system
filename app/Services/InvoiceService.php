<?php

namespace App\Services;

use App\Enums\InvoiceStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Http\Requests\PaymentEditRequest;
use App\Models\Invoice;

class InvoiceService
{
    /**
     * @param PaymentEditRequest $request
     * @param int $invoiceId
     * @return bool
     */
    public function updateInvoiceComplete(PaymentEditRequest $request, int $invoiceId): bool
    {
        if (PaymentStatusEnum::from($request->status) == PaymentStatusEnum::COMPLETE) {

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

        return false;
    }

}
