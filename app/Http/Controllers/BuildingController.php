<?php

namespace App\Http\Controllers;

use App\Models\Building;

class BuildingController extends Controller
{
    public function index(int $id)
    {
        return dd(Building::find($id)->floors);
    }
}
