<?php


namespace App\Rules;

use App\Enums\InvoiceStatusEnum;
use App\Models\Invoice;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class InvoiceExistedRule implements DataAwareRule, InvokableRule
{
    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected array $data = [];

    /**
     * Set the data under validation.
     * @param array<string, mixed> $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure $fail
     * @return void
     */
    public function __invoke(string $attribute, mixed $value, Closure $fail): void
    {
        $cycle = Carbon::parse($value);

        $invoice = Invoice::where('room_id', $this->data['room_id'])
            ->whereYear('cycle', $cycle->year)
            ->whereMonth('cycle', $cycle->month)
            ->where(function ($query) {
                $query->orWhere('status', InvoiceStatusEnum::PENDING)
                    ->orWhere('status', InvoiceStatusEnum::COMPLETE);
            })
            ->latest('id')
            ->first(['id']);

        if ($invoice) {
            $fail('มีรายการใบแจ้งหนี้ของห้องและเดือนที่เลือกแล้ว กรุณายกเลิกใบแจ้งหนี้เก่าก่อน');
        }
    }
}
