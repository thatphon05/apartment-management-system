<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use Illuminate\Http\RedirectResponse;

/**
 *
 */
class BookingController extends Controller
{

    public function __construct(private readonly BookingService $bookingService)
    {
    }

    public function cancelBooking(string $id): RedirectResponse
    {
        if (!$this->bookingService->cancelBooking($id)) {
            return redirect()->back()->with(['error' => 'เกิดข้อผิดพลาด']);
        }

        return redirect()->back()->with(['success' => 'ยกเลิกการเช่าสำเร็จ']);
    }
}
