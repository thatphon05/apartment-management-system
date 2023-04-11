<?php

namespace App\Services;

use App\Enums\BookingStatusEnum;
use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomService
{
    public function getRooms(): Collection
    {
        return Room::with([
            'floor.building',
            'bookings' => function (HasMany $hasMany) {
                $hasMany->where('status', BookingStatusEnum::ACTIVE)
                    ->latest();
            },
        ])
            ->oldest('id')
            ->get()
            ->sortBy(
                ['floor.building.name', 'floor.name', 'name']
            );
    }
}
