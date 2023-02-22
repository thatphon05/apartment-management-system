<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class BookingController extends Controller
{

    public function __construct(
        private readonly BookingService $bookingService,
        private readonly UserService    $userService,
    )
    {
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
}
