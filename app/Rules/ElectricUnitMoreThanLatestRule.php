<?php


namespace App\Rules;

use App\Models\UtilityExpense;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class ElectricUnitMoreThanLatestRule implements DataAwareRule, InvokableRule
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
            ->select('electric_unit')
            ->latest('cycle')
            ->first(['electric_unit']);

        if ($value < ($expenses->electric_unit ?? 0)) {
            $fail('กรุณาใส่เลขไฟฟ้าที่มากกว่าเดือนล่าสุด');
        }
    }
}
