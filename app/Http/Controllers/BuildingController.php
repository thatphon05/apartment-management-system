<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Floor;

class BuildingController extends Controller
{
    public function index(int $id)
    {
        return dd(Building::find($id)->floors);
    }

    public function floor(int $id)
    {
        return dd(Floor::find($id)->rooms);
    }
}
