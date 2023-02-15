<?php

namespace App\Services;

use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;

class RoomService
{

    public function getRooms(): Collection
    {
        return Room::with(['floor.building'])
            ->oldest('id')
            ->get()
            ->sortBy(
                ['floor.building.name', 'floor.name', 'name']
            );
    }
}
