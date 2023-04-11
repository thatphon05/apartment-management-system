<?php

namespace App\Rules;

use App\Enums\InvoiceStatusEnum;
use App\Models\Invoice;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class InvoiceLastDateNotExistedRule implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     */
    protected array $data = [];

    /**
     * Set the data under validation.
     *
     * @param array<string, mixed> $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cycle = Carbon::parse($value);

        $invoice = Invoice::whereYear('cycle', $cycle->year)
            ->whereMonth('cycle', $cycle->month)
            ->whereDate('last_date', '<', today())
            ->where('status', InvoiceStatusEnum::PENDING)
            ->latest('id')
            ->first(['id']);

        if (!$invoice) {
            $fail('ไม่มีใบแจ้งหนี้ที่ค้างชำระ');
        }
    }
}
