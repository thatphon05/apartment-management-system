<?php


namespace App\Rules;

use App\Models\UtilityExpense;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class UtilityExpenseCycleExistedRule implements DataAwareRule, InvokableRule
{
    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected array $data = [];

    /**
     * Set the data under validation.
     *
     * @param array $data
     * @return $this
     */
    public function setData($data)
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
    public function __invoke($attribute, $value, $fail)
    {
        $cycle = Carbon::parse($value);

        $expenses = UtilityExpense::where('room_id', $this->data['room_id'])
            ->whereYear('cycle', $cycle->year)
            ->whereMonth('cycle', $cycle->month)
            ->latest('id')
            ->first(['id']);

        if ($expenses) {
            $fail('มีรายการมิเตอร์ของเดือนที่เลือกแล้ว');
        }
    }
}
