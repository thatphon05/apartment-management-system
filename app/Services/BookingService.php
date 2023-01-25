<?php

namespace App\Services;

use App\Enums\BookingStatusEnum;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class BookingService
{

    /**
     * @param Request $request
     * @param User $userData
     * @return Booking
     */
    public function createBooking(Request $request, User $userData): Booking
    {
        return $userData->bookings()->create([
            'room_id' => $request->room_id,
            'rent_contract' => $request->file('rent_contract')->hashName(),
            'arrival_date' => $request->arrival_date,
            'deposit' => $request->deposit,
            'status' => BookingStatusEnum::ACTIVE,
            'parking_amount' => $request->parking_amount,
        ]);
    }

    /**
     * @param Request $request
     * @param $filename
     * @return void
     */
    public function uploadDocs(Request $request, $filename): void
    {
        $request->file('rent_contract')->storeAs(
            config('custom.rent_contract'), $filename
        );
    }

}
