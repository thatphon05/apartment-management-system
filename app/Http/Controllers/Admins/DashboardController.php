<?php

namespace App\Http\Controllers\Admins;

use App\Enums\BookingStatusEnum;
use App\Enums\InvoiceStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\RepairStatusEnum;
use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Repair;
use App\Models\Room;
use App\Models\User;
use App\Services\ChartService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private readonly ChartService $chartService)
    {
    }

    public function index(): View
    {
        // Room summary
        $totalRoom = Room::count();
        $totalRoomBooking = Booking::where('status', BookingStatusEnum::ACTIVE)
            ->count();

        return view('admins.dashboard', [
            // Room summary
            'totalRoom' => $totalRoom,
            'availableRoom' => $totalRoom - $totalRoomBooking,

            // Invoice summary
            'totalInvoice' => Invoice::count(),
            'totalInvoicePending' => Invoice::where('status', InvoiceStatusEnum::PENDING)->count(),

            // Repair summary
            'totalRepair' => Repair::count(),
            'totalRepairNew' => Repair::where('status', RepairStatusEnum::NEW)->count(),

            // User summary
            'totalUser' => User::count(),
            'totalUserActive' => User::where('status', UserStatusEnum::ACTIVE)->count(),

            // New repairs
            'repairs' => Repair::where('status', RepairStatusEnum::NEW)
                ->take(15)
                ->latest('id')
                ->get(),

            // New invoices
            'invoices' => Invoice::with([
                'room.floor.building',
                'payment',
            ])
                ->whereHas('payment', function (Builder $query) {
                    $query->where('status', PaymentStatusEnum::PENDING);
                })
                ->latest('updated_at')
                ->take(15)
                ->get(),
            'chartIncomeSummary' => $this->chartService->getIncomeSummary(),
            'chartIncomeMonth' => $this->chartService->getIncomeMonth(),
            'chartUtilityExpense' => $this->chartService->getUtilityExpenseConsumedSummary(),
        ]);
    }
}
