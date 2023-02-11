<?php


namespace App\Rules;

use App\Enums\BookingStatusEnum;
use App\Models\Booking;
use Illuminate\Contracts\Validation\InvokableRule;

class AvailableRoomRule implements InvokableRule
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
        $room = Booking::where('room_id', $value)
            ->where('status', BookingStatusEnum::ACTIVE)
            ->first(['id']);

        if ($room) {
            $fail('ห้องที่คุณเลือกมีผู้อื่นเช่าแล้ว');
        }
    }
}
