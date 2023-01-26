<?php

namespace App\Services;

use App\Enums\InvoiceStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Http\Requests\PaymentEditRequest;
use App\Models\Invoice;
use App\Models\Payment;

class InvoiceService
{
    public function updateInvoiceComplete(PaymentEditRequest $request, $paymentId): bool
    {
        if (PaymentStatusEnum::from($request->status) == PaymentStatusEnum::COMPLETE) {
            $payment = Payment::findOrFail($paymentId);
            Invoice::where('id', $payment->invoice_id)
                ->update(['status' => InvoiceStatusEnum::COMPLETE,]);

            return true;
        }

        return false;
    }

}
