<?php

namespace App\Http\Controllers\Admins;

use App\Enums\BookingStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomEditRequest;
use App\Models\Booking;
use App\Models\Configuration;
use App\Models\Invoice;
use App\Models\Repair;
use App\Models\Room;
use App\Models\UtilityExpense;
use App\Services\StorageService;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RoomController extends Controller
{

    /**
     * @param StorageService $storageService
     */
    public function __construct(private readonly StorageService $storageService)
    {
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $currentBooking = Booking::where('room_id', $id)
            ->where('status', BookingStatusEnum::ACTIVE)
            ->latest('id')->first();

        $rentContractSize = $currentBooking
            ? $this->storageService->getFileSizeMB(config('custom.rent_contract_path') . '/' . $currentBooking->rent_contract)
            : 0;

        return view('admins.rooms.show', [
            'room' => Room::with('configuration')->findOrFail($id)->first(),
            'currentBooking' => $currentBooking,
            'rentContractSize' => $rentContractSize,
            'bookings' => Booking::with('user')->where('room_id', $id)
                ->latest('id')->paginate(20),
            'invoices' => Invoice::with(['room.floor.building'])->where('room_id', $id)
                ->latest('id')->take(5)->get(),
            'repairs' => Repair::where('room_id', $id)->latest('id')->take(5)->get(),
            'utilityExpenses' => UtilityExpense::where('room_id', $id)->take(12)->get(),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        return view('admins.rooms.edit', [
            'room' => Room::findOrFail($id),
            'configurations' => Configuration::all(),
        ]);
    }

    /**
     * @param RoomEditRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RoomEditRequest $request, $id)
    {
        Room::where('id', $id)->update($request->validated());

        return redirect()->back()->with(['success' => 'แก้ไขสำเร็จ']);
    }

    /**
     * @param string $filename
     * @return StreamedResponse
     */
    public function downloadRentContract(string $filename): StreamedResponse
    {
        return $this->storageService->download(config('custom.rent_contract_path') . '/' . $filename);
    }
}
