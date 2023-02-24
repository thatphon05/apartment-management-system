<?php

namespace App\Http\Controllers\Users;

use App\Enums\BookingStatusEnum;
use App\Enums\RepairStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RepairCreateRequest;
use App\Models\Booking;
use App\Models\Repair;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RepairController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $searchLike = '%' . $search . '%';
        $status = $request->query('status', RepairStatusEnum::cases());
        $repairs_date = $request->query('repair_date', 0);
        $room = $request->query('room', 0);
        $user = auth()->user()->id;

        // filter
        $repairs = Repair::with('room.floor.building')
            ->where('user_id', $user)
            ->whereIn('status', $status)
            ->when($search != '', function (Builder $query) use ($searchLike) {
                $query->where('subject', 'like', $searchLike);
            })
            ->when($repairs_date > 0, function (Builder $query) use ($repairs_date) {
                $query->whereDate('repair_date', $repairs_date);
            })
            ->when($room > 0, function (Builder $query) use ($room) {
                $query->where('room_id', $room);
            })
            ->latest('id')
            ->paginate(40)
            ->withQueryString();

        return view('users.repairs.index', [
            'bookings' => Booking::with(['room.floor.building'])
                ->where('user_id', auth()->user()->id)
                ->where('status', BookingStatusEnum::ACTIVE)
                ->get(),
            'repairs' => $repairs,
        ]);
    }

    public function create(): View
    {
        return view('users.repairs.create', [
            'bookings' => Booking::with(['room.floor.building'])
                ->where('user_id', auth()->user()->id)
                ->where('status', BookingStatusEnum::ACTIVE)
                ->get(),
        ]);
    }

    public function store(RepairCreateRequest $request): RedirectResponse
    {
        $booking = Booking::with(['room'])
            ->where('user_id', auth()->user()->id)
            ->where('id', $request->booking_id)
            ->where('status', BookingStatusEnum::ACTIVE)
            ->first();

        // Check permission.
        if (!$booking) {
            abort(404);
        }

        Repair::create([
            'booking_id' => $request->booking_id,
            'user_id' => auth()->user()->id,
            'room_id' => $booking->room->id,
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => RepairStatusEnum::NEW,
        ]);

        return to_route('user.repairs.index');
    }

    public function show(string $id): View
    {
        $repair = Repair::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->first();

        // Check permission
        if (!$repair) {
            abort(404);
        }

        return view('users.repairs.show', [
            'repair' => $repair,
        ]);
    }

}
