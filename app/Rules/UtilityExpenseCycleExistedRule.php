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
        $cycle = Carbon::parse($value);

        $expenses = UtilityExpense::where('room_id', request()->room_id)
            ->whereYear('cycle', $cycle->year)
            ->whereMonth('cycle', $cycle->month)
            ->latest('id')
            ->first(['id']);
        //->first('id');

        if ($expenses) {
            $fail('มีรายการมิเตอร์ของเดือนที่เลือกแล้ว');
        }
    }
}
