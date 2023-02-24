<?php

namespace App\Http\Controllers\Users;

use App\Enums\BookingStatusEnum;
use App\Enums\RepairStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RepairCreateRequest;
use App\Models\Booking;
use App\Models\Repair;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RepairController extends Controller
{
    public function index(): View
    {
        return view('users.repairs.index');
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
}
