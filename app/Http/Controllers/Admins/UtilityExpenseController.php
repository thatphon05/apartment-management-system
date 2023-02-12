<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\UtilityExpense;

class UtilityExpenseController extends Controller
{
    public function index()
    {

    }

    public function show($roomId)
    {
        return view('admins.utility_expenses.index', [
            'expenses' => UtilityExpense::with(['room.floor.building'])
                ->where('room_id', $roomId)
                ->latest('cycle')
                ->paginate(40),
        ]);
    }

    public function create($roomId)
    {

    }

    public function store()
    {

    }

    public function edit($id)
    {

    }

    public function update($id)
    {

    }
}
