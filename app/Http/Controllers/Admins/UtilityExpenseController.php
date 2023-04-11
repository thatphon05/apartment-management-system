<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UtilityExpenseCreateRequest;
use App\Http\Requests\UtilityExpenseUpdateRequest;
use App\Models\UtilityExpense;
use App\Services\RoomService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UtilityExpenseController extends Controller
{
    public function __construct(
        private readonly RoomService $roomService,
    )
    {
    }

    public function index(Request $request): View
    {
        $month = $request->query('month', 0);
        $year = $request->query('year', 0);
        $room = $request->query('room', 0);

        return view('admins.utility_expenses.index', [
            'rooms' => $this->roomService->getRooms(),
            'expenses' => UtilityExpense::with([
                'room.floor.building',
            ])
                ->when($month > 0, function (Builder $query) use ($month) {
                    $query->whereMonth('cycle', $month);
                })
                ->when($year > 0, function (Builder $query) use ($year) {
                    $query->whereYear('cycle', $year);
                })
                ->when($room > 0, function (Builder $query) use ($room) {
                    $query->where('room_id', $room);
                })
                ->latest('cycle')
                ->oldest('room_id')
                ->paginate(50)
                ->withQueryString(),
        ]);
    }

    public function create(): View
    {
        return view('admins.utility_expenses.create', [
            'rooms' => $this->roomService->getRooms(),
        ]);
    }

    public function store(UtilityExpenseCreateRequest $request): RedirectResponse
    {
        $cycle = Carbon::parse($request->cycle)->setDay(1);

        // Get last utility expense
        $lastUtilityExpense = UtilityExpense::where('room_id', $request->room_id)
            ->whereDate('cycle', '<', $cycle)
            ->latest('cycle')
            ->first();

        $water_unit = $request->water_unit;
        $electric_unit = $request->electric_unit;

        UtilityExpense::create([
            'water_unit' => $water_unit,
            'electric_unit' => $electric_unit,
            'water_consumed' => $water_unit - ($lastUtilityExpense->water_unit ?? 0),
            'electric_consumed' => $electric_unit - ($lastUtilityExpense->electric_unit ?? 0),
            'cycle' => $cycle,
            'room_id' => $request->room_id,
        ]);

        return to_route('admin.expenses.index', ['room' => $request->room_id]);
    }

    public function edit(string $id): View
    {
        return view('admins.utility_expenses.edit', [
            'utilityExpense' => UtilityExpense::with('room.floor.building')
                ->findOrFail($id),
        ]);
    }

    public function update(UtilityExpenseUpdateRequest $request, string $id)
    {
        $utilityExpense = UtilityExpense::findOrFail($id);

        // get last utility expense except self
        $lastUtilityExpense = UtilityExpense::where('room_id', $utilityExpense->room_id)
            ->whereDate('cycle', '<', $utilityExpense->cycle)
            ->latest('cycle')
            ->first();

        $water_unit = $request->water_unit;
        $electric_unit = $request->electric_unit;

        $utilityExpense->update([
            'water_unit' => $water_unit,
            'electric_unit' => $electric_unit,
            'water_consumed' => $water_unit - ($lastUtilityExpense->water_unit ?? 0),
            'electric_consumed' => $electric_unit - ($lastUtilityExpense->electric_unit ?? 0),
        ]);

        return to_route('admin.expenses.index', ['room' => $utilityExpense->room_id])
            ->with('success', 'แก้ไขสำเร็จ');
    }
}
