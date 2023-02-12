<?php

namespace App\Services;

use App\Models\Room;

class RoomService
{
    /**
     * @return Room[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\LaravelIdea\Helper\App\Models\_IH_Room_C|\LaravelIdea\Helper\App\Models\_IH_Room_QB[]
     */
    public function getRooms()
    {
        $rooms = Room::with(['floor.building'])->oldest('id')->get();

        return $rooms->sortBy(
            ['floor.building.name', 'floor.name', 'name'],
        );
    }
}
