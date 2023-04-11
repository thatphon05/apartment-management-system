<?php

namespace App\Http\Controllers\Users;

use App\Enums\InvoiceStatusEnum;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        return view('users.dashboard', [
            'user' => $user,
            'bookings' => $user->bookings()
                ->with(['room.floor.building'])
                ->latest()
                ->get(),
            'invoices' => $user->invoices()
                ->with(['room.floor.building', 'payment'])
                ->where('status', InvoiceStatusEnum::PENDING)
                ->latest('cycle')
                ->take(10)
                ->get(),
        ]);
    }
}
