<?php


namespace App\Rules;

use App\Enums\BookingStatusEnum;
use App\Models\Booking;
use Closure;
use Illuminate\Contracts\Validation\InvokableRule;

class AvailableRoomRule implements InvokableRule
{
    /**
     * Run the validation rule.
     */
    public function __invoke(string $attribute, mixed $value, Closure $fail): void
    {
        $room = Booking::where('room_id', $value)
            ->where('status', BookingStatusEnum::ACTIVE)
            ->first(['id']);

        if ($room) {
            $fail('ห้องที่คุณเลือกมีผู้อื่นเช่าแล้ว');
        }
    }
}
