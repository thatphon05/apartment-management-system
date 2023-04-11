<?php

namespace App\Rules;

use App\Models\Configuration;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HasConfigurationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $room = Configuration::where('id', $value)->first(['id']);

        if (!$room) {
            $fail('ไม่พบราคาที่คุณเลือก');
        }
    }
}
