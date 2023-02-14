<?php

namespace App\Http\Controllers\Admins;

use App\Enums\RepairStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEditRepairRequest;
use App\Models\Repair;
use App\Services\RoomService;
use Illuminate\Http\Request;

class RepairController extends Controller
{

    public function __construct(
        private readonly RoomService $roomService
    )
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $searchLike = '%' . $search . '%';
        $status = $request->query('status', RepairStatusEnum::cases());
        $repairs_date = $request->query('repair_date', 0);
        $room = $request->query('room', 0);
        $user = $request->query('user', 0);

        // filter
        $repairs = Repair::with(['room.floor.building'])
            ->whereIn('status', $status)
            ->when($search != '', function ($query) use ($searchLike) {
                $query->where('subject', 'like', $searchLike);
            })
            ->when($user > 0, function ($query) use ($user) {
                $query->where('user_id', $user);
            })
            ->when($repairs_date > 0, function ($query) use ($repairs_date) {
                $query->whereDate('repair_date', $repairs_date);
            })
            ->when($room > 0, function ($query) use ($room) {
                $query->where('room_id', $room);
            });

        return view('admins.repairs.index', [
            'repairs' => $repairs->latest('id')->paginate(40),
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
