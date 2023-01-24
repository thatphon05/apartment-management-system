<?php

namespace App\Http\Controllers\Admins;

use App\Enums\BookingStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        return view('admins.buildings.index', [
            'buildings' => Building::all(),
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(int $id)
    {
        return view('admins.buildings.show', [
            'building' => Building::findOrFail($id)->with(['floors.rooms.bookings' => function ($query) {
                $query->where('status', BookingStatusEnum::ACTIVE)->get();
            }])->first(),
        ]);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
