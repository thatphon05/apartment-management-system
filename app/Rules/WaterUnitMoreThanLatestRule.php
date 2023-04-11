<?php

namespace App\Rules;

use App\Models\UtilityExpense;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class WaterUnitMoreThanLatestRule implements DataAwareRule, ValidationRule
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
        $cycle = Carbon::parse($this->data['cycle']);

        $expenses = UtilityExpense::where('room_id', $this->data['room_id'])
            ->whereDate('cycle', '<', $cycle)
            ->select('water_unit')
            ->latest('cycle')
            ->first(['water_unit']);

        if ($value < ($expenses->water_unit ?? 0)) {
            $fail('กรุณาใส่มิเตอร์น้ำที่มากกว่าเดือนล่าสุด');
        }
    }
}
