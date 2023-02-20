<?php

namespace App\Services;

use App\Enums\BookingStatusEnum;
use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;

class RoomService
{

    public function getRooms(): Collection
    {
        return Room::with(['floor.building', 'bookings' => function ($query) {
            $query->where('status', BookingStatusEnum::ACTIVE)->latest()->first();
        }])
            ->oldest('id')
            ->get()
            ->sortBy(
                ['floor.building.name', 'floor.name', 'name']
            );
    }
}
