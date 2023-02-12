<?php


namespace App\Rules;

use App\Models\UtilityExpense;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\InvokableRule;

class UtilityExpenseCycleExistedRule implements InvokableRule
{
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
        $cycle = Carbon::parse($value)->setDay(1);

        $expenses = UtilityExpense::whereDate('cycle', $cycle)
            ->where('room_id', request()->room_id)
            ->latest('id')
            ->first(['id']);

        if ($expenses) {
            $fail('มีรายการมิเตอร์ของเดือนที่เลือกแล้ว');
        }
    }
}
