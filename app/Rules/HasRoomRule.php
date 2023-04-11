<?php

namespace App\Rules;

use App\Models\Room;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HasRoomRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Room::find($value)) {
            $fail('ไม่พบห้องที่คุณเลือก');
        }
    }
}
