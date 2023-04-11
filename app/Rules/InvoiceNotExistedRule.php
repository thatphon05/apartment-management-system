<?php

namespace App\Rules;

use App\Enums\InvoiceStatusEnum;
use App\Models\Invoice;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class InvoiceNotExistedRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cycle = Carbon::parse($value);

        $invoice = Invoice::whereYear('cycle', $cycle->year)
            ->whereMonth('cycle', $cycle->month)
            ->where('status', InvoiceStatusEnum::COMPLETE)
            ->latest('id')
            ->first(['id']);

        if (!$invoice) {
            $fail('ยังไม่มีใบแจ้งหนี้ของเดือนที่คุณเลือก');
        }
    }
}
