<?php

namespace App\Http\Controllers\Admins;

use App\Enums\BookingStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Building;

class BuildingController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admins.buildings.index', [
            'buildings' => Building::all(),
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        return view('admins.buildings.show', [
            'building' => Building::findOrFail($id)->with(['floors.rooms.bookings' => function ($query) {
                $query->where('status', BookingStatusEnum::ACTIVE)->get();
            }])->first(),
        ]);
    }

}
