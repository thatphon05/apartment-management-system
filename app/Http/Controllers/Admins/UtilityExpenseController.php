<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UtilityExpenseCreateRequest;
use App\Models\UtilityExpense;
use App\Services\RoomService;
use Illuminate\View\View;

class UtilityExpenseController extends Controller
{

    public function __construct(
        private readonly RoomService $roomService,
    )
    {
    }

    public function index()
    {

    }

    public function show(string $roomId): View
    {
        return view('admins.utility_expenses.show', [
            'expenses' => UtilityExpense::with(['room.floor.building'])
                ->where('room_id', $roomId)
                ->latest('cycle')
                ->paginate(40),
            'roomId' => $roomId,
        ]);
    }

    public function create(): View
    {
        return view('admins.utility_expenses.create', [
            'rooms' => $this->roomService->getRooms(),
        ]);
    }

    public function store(UtilityExpenseCreateRequest $request)
    {
        UtilityExpense::create([
            'water_unit' => $request->water_unit,
            'electric_unit' => $request->electric_unit,
            'cycle' => $request->cycle,
            'room_id' => $request->room_id,
        ]);

        return to_route('admin.expenses.show', ['roomId' => $request->room_id]);
    }

    public function edit(string $id)
    {

    }

    public function update(string $id)
    {

    }
}
