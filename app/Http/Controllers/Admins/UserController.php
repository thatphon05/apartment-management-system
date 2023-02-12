<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Booking;
use App\Models\Configuration;
use App\Models\Invoice;
use App\Models\Repair;
use App\Models\User;
use App\Services\BookingService;
use App\Services\RoomService;
use App\Services\StorageService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    /**
     * @param UserService $userService
     * @param BookingService $bookingService
     * @param StorageService $storageService
     */
    public function __construct(
        private readonly UserService    $userService,
        private readonly BookingService $bookingService,
        private readonly StorageService $storageService,
        private readonly RoomService    $roomService,
    )
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('admins.users.index', [
            'users' => $this->userService->searchUser($request),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admins.users.create', [
            'rooms' => $this->roomService->getRooms(),
            'config' => Configuration::latest()->first(),
        ]);
    }

    /**
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateRequest $request)
    {
        static $user;

        DB::transaction(function () use ($request, &$user) {

            $user = $this->userService->createUser($request);

            $this->userService->uploadIdCardDoc($request, $user->id_card_copy);

            $this->userService->uploadCopyHouseDoc($request, $user->copy_house_registration);

            $booking = $this->bookingService->createBooking($request, $user);

            $this->bookingService->uploadDocs($request, $booking->rent_contract);

        });

        return to_route('admin.users.show', ['user' => $user->id])
            ->with(['success' => 'เพิ่มผู้เช่าใหม่สำเร็จ']);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $idCardPath = config('custom.id_card_copy_path') . '/' . $user->id_card_copy;
        $idCardCopySizeMB = $this->storageService->getFileSizeMB($idCardPath);

        $housePath = config('custom.copy_house_registration_path') . '/' . $user->copy_house_registration;
        $copyHouseRegSizeMB = $this->storageService->getFileSizeMB($housePath);

        return view('admins.users.show', [
            'user' => $user,
            'bookings' => Booking::with('room.floor.building')->where('user_id', $id)
                ->latest('id')->get(),
            'invoices' => Invoice::with(['room.floor.building', 'payments'])->where('user_id', $id)
                ->latest('id')->take(5)->get(),
            'repairs' => Repair::where('user_id', $id)->latest('id')->take(5)->get(),
            'idCardCopySize' => $idCardCopySizeMB,
            'copyHouseRegSize' => $copyHouseRegSizeMB,
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        return view('admins.users.edit', [
            'user' => User::findOrFail($id)->first(),
        ]);
    }

    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->userService->updateUser($request, $id);

        return to_route('admin.users.show', ['user' => $user->id])
            ->with(['success' => 'แก้ไขสำเร็จ']);
    }

    /**
     * @param $filename
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadIdCardCopy($filename)
    {
        return $this->storageService->download(config('custom.id_card_copy_path') . '/' . $filename);
    }

    /**
     * @param $filename
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadHouseRegCopy($filename)
    {
        return $this->storageService->download(config('custom.copy_house_registration_path') . '/' . $filename);
    }
}
