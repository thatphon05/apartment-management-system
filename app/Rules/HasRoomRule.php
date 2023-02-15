<?php


namespace App\Rules;

use App\Models\Room;
use Closure;
use Illuminate\Contracts\Validation\InvokableRule;

class HasRoomRule implements InvokableRule
{
    /**
     * Run the validation rule.
     */
    public function __invoke(string $attribute, mixed $value, Closure $fail): void
    {
        $room = Room::where('id', $value)->first(['id']);

        if (!$room) {
            $fail('ไม่พบห้องที่คุณเลือก');
        }
    }
}
