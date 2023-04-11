<?php

namespace App\Http\Controllers\Admins;

use App\Enums\BookingStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomEditRequest;
use App\Models\Configuration;
use App\Models\Room;
use App\Services\StorageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RoomController extends Controller
{
    public function __construct(private readonly StorageService $storageService)
    {
    }

    public function show(string $id): View
    {
        $room = Room::with(['configuration', 'floor.building'])
            ->findOrFail($id);

        $currentBooking = $room->bookings()
            ->with('user')
            ->where('status', BookingStatusEnum::ACTIVE)
            ->latest('id')
            ->first();

        $rentContractSize = $currentBooking
            ? $this->storageService->getFileSizeMB(
                $currentBooking->rental_contract, config('custom.rent_contract_path')
            )
            : 0;

        return view('admins.rooms.show', [
            'room' => $room,
            'currentBooking' => $currentBooking,
            'rentContractSize' => $rentContractSize,
            'bookings' => $room->bookings()
                ->with('user')
                ->latest('id')
                ->paginate(20)
                ->withQueryString(),
            'invoices' => $room->invoices()
                ->with(['room.floor.building', 'payment'])
                ->latest('id')
                ->take(5)
                ->get(),
            'repairs' => $room->repairs()
                ->latest('id')
                ->take(15)
                ->get(),
            'utilityExpenses' => $room->utilityExpenses()
                ->latest('cycle')
                ->take(15)
                ->get(),
        ]);
    }

    public function edit(string $id): View
    {
        return view('admins.rooms.edit', [
            'room' => Room::findOrFail($id),
            'configurations' => Configuration::all(),
        ]);
    }

    public function update(RoomEditRequest $request, string $id): RedirectResponse
    {
        Room::findOrFail($id)->update($request->validated());

        return redirect()->back()->with(['success' => 'แก้ไขสำเร็จ']);
    }

    public function downloadRentContract(string $filename): StreamedResponse|Response
    {
        return $this->storageService->viewFile(
            $filename, config('custom.rent_contract_path')
        );
    }
}
