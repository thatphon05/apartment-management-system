<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\StorageService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BookingController extends Controller
{
    public function __construct(private readonly StorageService $storageService)
    {
    }

    public function show(string $id): View
    {
        $booking = Booking::with(['room.configuration', 'room.floor.building'])
            ->findOrFail($id);

        Gate::authorize('view', $booking);

        $rentContractSize = $booking
            ? $this->storageService->getFileSizeMB(
                $booking->rental_contract, config('custom.rent_contract_path')
            )
            : 0;

        return view('users.bookings.show', [
            'rentContractSize' => $rentContractSize,
            'booking' => $booking,
        ]);
    }

    public function downloadRentContract(string $id): StreamedResponse|Response
    {
        $booking = Booking::findOrFail($id);

        Gate::authorize('downloadRentalContract', $booking);

        return $this->storageService->viewFile(
            $booking->rental_contract, config('custom.rent_contract_path')
        );
    }
}
