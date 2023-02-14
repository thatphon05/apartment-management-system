<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEditRepairRequest;
use App\Models\Repair;
use App\Services\RepairService;
use App\Services\RoomService;
use Illuminate\Http\Request;

class RepairController extends Controller
{

    public function __construct(
        private readonly RoomService   $roomService,
        private readonly RepairService $repairService,
    )
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('admins.repairs.index', [
            'repairs' => $this->repairService->searchRepair($request),
            'rooms' => $this->roomService->getRooms(),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        return view('admins.repairs.edit', [
            'repair' => Repair::findOrFail($id),
        ]);
    }

    /**
     * @param AdminEditRepairRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminEditRepairRequest $request, $id)
    {
        Repair::where('id', $id)->update([
            'status' => $request->status,
            'repair_date' => $request->repair_date !== null ? convertDateToAD($request->repair_date) : null,
            'note' => $request->note,
        ]);

        return redirect()->back()->with(['success' => 'ดำเนินการเปลี่ยนสถานะสำเร็จ']);
    }

}
