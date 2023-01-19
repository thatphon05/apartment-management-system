<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\Configuration;
use App\Models\Room;
use App\Services\BookingService;
use App\Services\UserService;

class UserController extends Controller
{

    public function __construct(
        private UserService    $userService,
        private BookingService $bookingService
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

    public function create()
    {
        return view('admins.users.create', [
            'rooms' => Room::with('floor')->oldest('id')->get(),
            'config' => Configuration::latest()->first(),
        ]);
    }

    public function store(UserCreateRequest $request)
    {
        $user = $this->userService->createUser($request);
        $this->userService->uploadDocs(
            $request,
            $user->id_card_copy,
        );

        $booking = $this->bookingService->createBooking($request, $user);
        $this->bookingService->uploadDocs(
            $request,
            $booking->rent_contract,
        );

        return to_route('admin.users.index');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
