<?php


namespace App\Rules;

use App\Models\UtilityExpense;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class WaterUnitMoreThanLatestRule implements DataAwareRule, InvokableRule
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
        $expenses = UtilityExpense::where('room_id', $this->data['room_id'])
            ->select('water_unit')
            ->latest('cycle')
            ->first(['water_unit']);

        if ($value < $expenses->water_unit) {
            $fail('กรุณาใส่เลขน้ำที่มากกว่าเดือนที่แล้ว');
        }
    }
}
