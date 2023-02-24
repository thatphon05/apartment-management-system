<?php


namespace App\Rules;

use App\Models\UtilityExpense;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class UtilityExpenseCycleNotExistedRule implements DataAwareRule, ValidationRule
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
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cycle = Carbon::parse($value);

        $expenses = UtilityExpense::where('room_id', $this->data['room_id'])
            ->whereYear('cycle', $cycle->year)
            ->whereMonth('cycle', $cycle->month)
            ->latest('id')
            ->first(['id']);

        if (!$expenses) {
            $fail('ยังไม่มีรายการมิเตอร์ของเดือนที่เลือก กรุณาเพิ่มก่อน');
        }
    }
}
