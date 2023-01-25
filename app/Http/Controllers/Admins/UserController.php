<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Booking;
use App\Models\Configuration;
use App\Models\Invoice;
use App\Models\Repair;
use App\Models\Room;
use App\Models\User;
use App\Services\BookingService;
use App\Services\StorageService;
use App\Services\UserService;

class UserController extends Controller
{

    public function __construct(
        private UserService    $userService,
        private BookingService $bookingService,
        private StorageService $storageService,
    )
    {
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admins.users.index', [
            'users' => $this->userService->searchUser(request()),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $rooms = Room::with(['floor.building'])->oldest('id')->get();
        $rooms = $rooms->sortBy(
            ['floor.building.name', 'floor.name', 'name'],
        );
        return view('admins.users.create', [
            'rooms' => $rooms,
            'config' => Configuration::latest()->first(),
        ]);
    }

    /**
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateRequest $request)
    {
        $user = $this->userService->createUser($request);
        $this->userService->uploadIdCardDoc($request, $user->id_card_copy);
        $this->userService->uploadCopyHouseDoc($request, $user->copy_house_registration);

        $booking = $this->bookingService->createBooking($request, $user);
        $this->bookingService->uploadDocs($request, $booking->rent_contract);

        return to_route('admin.users.index');
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
            'invoices' => Invoice::with('booking.room.floor.building')->where('user_id', $id)
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
        return to_route('admin.users.show', ['user' => $user->id]);
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
