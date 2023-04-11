<?php

namespace App\Http\Controllers\Admins;

use App\Enums\BookingStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\View\View;

class BuildingController extends Controller
{
    public function index(): View
    {
        return view('admins.buildings.index', [
            'buildings' => Building::all(),
        ]);
    }

    public function show(string $id): View
    {
        return view('admins.buildings.show', [
            'building' => Building::with([
                'floors.rooms.bookings' => function (HasMany $hasMany) {
                    $hasMany->where('status', BookingStatusEnum::ACTIVE);
                },
            ])->findOrFail($id),
        ]);
    }
}
