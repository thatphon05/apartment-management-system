<?php

namespace App\Policies;

use App\Enums\InvoiceStatusEnum;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InvoicePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Invoice $invoice): Response
    {
        return $user->id === $invoice->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create payment.
     */
    public function createPayment(User $user, Invoice $invoice): Response
    {
        return ($user->id === $invoice->user_id && !$invoice->payment()->first()
            && $invoice->status !== InvoiceStatusEnum::COMPLETE)
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update payment
     */
    public function updatePayment(User $user, Invoice $invoice): Response
    {
        return $user->id === $invoice->user_id && $invoice->status !== InvoiceStatusEnum::COMPLETE
        && $invoice->payment()->first()
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can download receipt.
     */
    public function downloadReceipt(User $user, Invoice $invoice): Response
    {
        return $user->id === $invoice->user_id && $invoice->status === InvoiceStatusEnum::COMPLETE
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
