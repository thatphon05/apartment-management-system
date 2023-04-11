<?php

namespace App\Http\Controllers\Admins;

use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminBookingUpdateRequest;
use App\Http\Requests\BookingCreateRequest;
use App\Models\Booking;
use App\Models\Configuration;
use App\Models\User;
use App\Services\BookingService;
use App\Services\RoomService;
use App\Services\StorageService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function __construct(
        private readonly BookingService $bookingService,
        private readonly UserService    $userService,
        private readonly RoomService    $roomService,
        private readonly StorageService $storageService,
    )
    {
    }

    public function create(): View
    {
        return view('admins.bookings.create', [
            'rooms' => $this->roomService->getRooms(),
            'config' => Configuration::latest()->first(),
            'user' => User::findOrFail(request()->query('user')),
        ]);
    }

    public function store(BookingCreateRequest $request): RedirectResponse
    {
        $user = User::findOrFail($request->user_id);

        DB::transaction(function () use ($request, $user) {
            $user->status = UserStatusEnum::ACTIVE;

            $this->bookingService->createBooking($request, $user);

            $this->bookingService->uploadDocs($request, $request->file('rent_contract')->hashName());
        });

        return to_route('admin.users.show', ['user' => $user->id]);
    }

    public function cancelBooking(Request $request, string $id): RedirectResponse
    {
        DB::transaction(function () use ($id, $request) {
            $this->bookingService->cancelBooking($id);

            if ($request->has(['is_suspend_user', 'user_id'])) {
                $this->userService->suspendUser($request->user_id);
            }
        });

        return redirect()->back()->with(['success' => 'ยกเลิกการเช่าสำเร็จ']);
    }

    public function show(string $id): View
    {
        $booking = Booking::with(['room.configuration', 'room.floor.building'])
            ->findOrFail($id);

        $rentContractSize = $booking
            ? $this->storageService->getFileSizeMB(
                $booking->rental_contract, config('custom.rent_contract_path')
            )
            : 0;

        return view('admins.bookings.show', [
            'rentContractSize' => $rentContractSize,
            'booking' => $booking,
        ]);
    }

    public function getEditBooking(string $id): View
    {
        return view('admins.bookings.edit', [
            'booking' => Booking::findOrFail($id),
        ]);
    }

    public function postEditBooking(AdminBookingUpdateRequest $request, string $id): RedirectResponse
    {
        Booking::findOrFail($id)->update([
            'parking_amount' => $request->parking_amount,
            'arrival_date' => $request->arrival_date,
        ]);

        return to_route('admin.booking.show', ['id' => $id])->with(['success' => 'แก้ไขสำเร็จ']);
    }
}
