<?php

namespace App\Services;

use App\Enums\RepairStatusEnum;
use App\Models\Repair;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class RepairService
{
    public function searchRepair(Request $request): LengthAwarePaginator
    {
        $search = $request->query('search');
        $searchLike = '%' . $search . '%';
        $status = $request->query('status', RepairStatusEnum::cases());
        $repairs_date = $request->query('repair_date', 0);
        $room = $request->query('room', 0);
        $user = $request->query('user', 0);

        // filter
        return Repair::with('room.floor.building')
            ->whereIn('status', $status)
            ->when($search !== '', function (Builder $query) use ($searchLike) {
                $query->where('subject', 'like', $searchLike);
            })
            ->when($user > 0, function (Builder $query) use ($user) {
                $query->where('user_id', $user);
            })
            ->when($repairs_date > 0, function (Builder $query) use ($repairs_date) {
                $query->whereDate('repair_date', $repairs_date);
            })
            ->when($room > 0, function (Builder $query) use ($room) {
                $query->where('room_id', $room);
            })
            ->latest('id')
            ->paginate(50)
            ->withQueryString();
    }
}
