<?php

namespace App\Http\Controllers\Admins;

use App\Enums\RepairStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEditRepairRequest;
use App\Models\Repair;

class RepairController extends Controller
{

    public function index()
    {
        $search = request()->query('search', '');
        $searchLike = '%' . $search . '%';
        $status = request()->query('status', RepairStatusEnum::cases());

        // filter
        $repairs = Repair::with(['room.floor.building'])
            ->orWhere(function ($query) use ($searchLike) {
                $query->orWhere('subject', 'like', $searchLike);
            })
            ->whereIn('status', $status)
            ->orderBy('id', 'desc')
            ->paginate(40);

        return view('admins.repairs.index', [
            'repairs' => $repairs,
        ]);
    }

    public function edit($id)
    {
        return view('admins.repairs.edit', [
            'repair' => Repair::findOrFail($id),
        ]);
    }

    public function update(AdminEditRepairRequest $request, $id)
    {
        Repair::where('id', $id)->update([
            'status' => $request->status,
            'repair_date' => convertDateToAD($request->repair_date),
            'note' => $request->note,
        ]);

        return redirect()->back()->with(['success' => 'ดำเนินการเปลี่ยนสถานะสำเร็จ']);
    }

}
