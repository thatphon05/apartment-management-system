<?php

namespace App\Http\Controllers\Admins;

use App\Enums\RepairStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEditRepairRequest;
use App\Models\Repair;
use Illuminate\Http\Request;

class RepairController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $searchLike = '%' . $search . '%';
        $status = $request->query('status', RepairStatusEnum::cases());

        // filter
        $repairs = Repair::with(['room.floor.building'])
            ->orWhere(function ($query) use ($searchLike) {
                $query->orWhere('subject', 'like', $searchLike);
            })
            ->whereIn('status', $status)
            ->latest('id')
            ->paginate(40);

        return view('admins.repairs.index', [
            'repairs' => $repairs,
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
