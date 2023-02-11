<?php


namespace App\Rules;

use App\Models\Configuration;
use Illuminate\Contracts\Validation\InvokableRule;

class HasConfigurationRule implements InvokableRule
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
        $room = Configuration::where('id', $value)->first(['id']);

        if (!$room) {
            $fail('ไม่พบราคาที่คุณเลือก');
        }
    }
}
