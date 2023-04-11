<?php

namespace App\Services;

use App\Enums\BookingStatusEnum;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class BookingService
{
    public function createBooking(Request $request, User $userData): Booking
    {
        return $userData->bookings()->create([
            'room_id' => $request->room_id,
            'rental_contract' => $request->file('rent_contract')->hashName(),
            'arrival_date' => $request->arrival_date,
            'deposit' => $request->deposit,
            'status' => BookingStatusEnum::ACTIVE,
            'parking_amount' => $request->parking_amount,
        ]);
    }

    public function uploadDocs(Request $request, string $filename): void
    {
        $request->file('rent_contract')->storeAs(
            config('custom.rent_contract_path'),
            $filename
        );
    }

    public function cancelBooking(string $id): bool
    {
        return Booking::findOrFail($id)->update([
            'status' => BookingStatusEnum::INACTIVE,
        ]);
    }
}
