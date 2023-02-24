<?php


namespace App\Rules;

use App\Enums\BookingStatusEnum;
use App\Models\Booking;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HasBooking implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $booking = Booking::where('room_id', $value)
            ->where('status', BookingStatusEnum::ACTIVE)
            ->latest('id')
            ->first(['id']);

        if (!$booking) {
            $fail('ไม่พบผู้พักในห้องทีคุณเลือก');
        }
    }

}
