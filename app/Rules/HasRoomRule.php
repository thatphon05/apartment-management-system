<?php


namespace App\Rules;

use App\Models\Room;
use Illuminate\Contracts\Validation\InvokableRule;

class HasRoomRule implements InvokableRule
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
        $room = Room::where('id', $value)->first(['id']);

        if (!$room) {
            $fail('ไม่พบห้องที่คุณเลือก');
        }
    }
}
