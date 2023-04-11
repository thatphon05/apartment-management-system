<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Configuration;
use App\Models\User;
use App\Services\BookingService;
use App\Services\RoomService;
use App\Services\StorageService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService    $userService,
        private readonly BookingService $bookingService,
        private readonly StorageService $storageService,
        private readonly RoomService    $roomService,
    )
    {
    }

    public function index(Request $request): View
    {
        return view('admins.users.index', [
            'users' => $this->userService->searchUser($request),
        ]);
    }

    public function create(): View
    {
        return view('admins.users.create', [
            'rooms' => $this->roomService->getRooms(),
            'config' => Configuration::latest()->first(),
        ]);
    }

    public function store(UserCreateRequest $request): RedirectResponse
    {
        static $user;

        DB::transaction(function () use ($request, &$user) {
            $user = $this->userService->createUser($request);

            $this->userService->uploadIdCardDoc($request, $user->id_card_copy);

            $this->userService->uploadCopyHouseDoc($request, $user->copy_house_registration);

            $booking = $this->bookingService->createBooking($request, $user);

            $this->bookingService->uploadDocs($request, $booking->rental_contract);
        });

        return to_route('admin.users.show', ['user' => $user->id])
            ->with(['success' => 'เพิ่มผู้เช่าใหม่สำเร็จ']);
    }

    public function show(string $id): View
    {
        $user = User::findOrFail($id);

        $idCardCopySizeMB = $this->storageService->getFileSizeMB(
            $user->id_card_copy,
            config('custom.id_card_copy_path')
        );

        $copyHouseRegSizeMB = $this->storageService->getFileSizeMB(
            $user->copy_house_registration, config('custom.copy_house_registration_path')
        );

        return view('admins.users.show', [
            'user' => $user,
            'bookings' => $user->bookings()
                ->with('room.floor.building')
                ->latest('id')
                ->get(),
            'invoices' => $user->invoices()
                ->with(['room.floor.building', 'payment'])
                ->latest('id')
                ->take(10)
                ->get(),
            'repairs' => $user->repairs()
                ->latest('id')
                ->take(10)
                ->get(),
            'idCardCopySize' => $idCardCopySizeMB,
            'copyHouseRegSize' => $copyHouseRegSizeMB,
        ]);
    }

    public function edit(string $id): View
    {
        return view('admins.users.edit', [
            'user' => User::findOrFail($id),
            'rooms' => $this->roomService->getRooms(),
        ]);
    }

    public function update(UserUpdateRequest $request, string $id): RedirectResponse
    {
        $user = $this->userService->updateUser($request, $id);

        return to_route('admin.users.show', ['user' => $user->id])
            ->with(['success' => 'แก้ไขสำเร็จ']);
    }

    public function downloadIdCardCopy(string $filename): StreamedResponse|Response
    {
        return $this->storageService->viewFile(
            $filename, config('custom.id_card_copy_path')
        );
    }

    public function downloadHouseRegCopy(string $filename): StreamedResponse|Response
    {
        return $this->storageService->viewFile(
            $filename, config('custom.copy_house_registration_path')
        );
    }
}
