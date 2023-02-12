<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use Illuminate\Http\RedirectResponse;

class BookingController extends Controller
{
    /**
     * @param BookingService $bookingService
     */
    public function __construct(private readonly BookingService $bookingService)
    {
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function cancelBooking($id): RedirectResponse
    {
        if (!$this->bookingService->cancelBooking($id)) {
            return redirect()->back()->with(['error' => 'เกิดข้อผิดพลาด']);
        }

        return redirect()->back()->with(['success' => 'ยกเลิกการเช่าสำเร็จ']);
    }
}
