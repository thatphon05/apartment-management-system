<?php

namespace App\Services;

use App\Enums\BookingStatusEnum;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingService
{

    /**
     * @param Request $request
     * @param User $userData
     * @return Booking
     */
    public function createBooking(Request $request, User $userData): Booking
    {
        return Booking::create([
            'user_id' => $userData->id,
            'room_id' => $request->room_id,
            'rent_contract' => Str::uuid() . '.pdf',
            'contract_start' => now(),
            'contract_end' => now(),
            'deposit' => 2000,
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
            'rent_contract', $filename
        );
    }

}
