<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEditRepairRequest;
use App\Models\Repair;
use App\Services\RepairService;
use App\Services\RoomService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RepairController extends Controller
{
    public function __construct(
        private readonly RoomService   $roomService,
        private readonly RepairService $repairService,
    )
    {
    }

    public function index(Request $request): View
    {
        return view('admins.repairs.index', [
            'repairs' => $this->repairService->searchRepair($request),
            'rooms' => $this->roomService->getRooms(),
        ]);
    }

    public function edit(string $id): View
    {
        return view('admins.repairs.edit', [
            'repair' => Repair::findOrFail($id),
        ]);
    }

    public function update(AdminEditRepairRequest $request, string $id): RedirectResponse
    {
        Repair::findOrFail($id)->update([
            'status' => $request->status,
            'repair_date' => $request->repair_date !== null ? convertDateToAD($request->repair_date) : null,
            'note' => $request->note,
        ]);

        return redirect()->back()->with(['success' => 'ดำเนินการเปลี่ยนสถานะสำเร็จ']);
    }
}
