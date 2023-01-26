<?php

namespace App\Http\Controllers\Admins;

use App\Enums\BookingStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Repair;
use App\Models\Room;
use App\Models\UtilityExpense;
use App\Services\StorageService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RoomController extends Controller
{

    public function __construct(private StorageService $storageService)
    {
    }

    public function index()
    {

    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $currentBooking = Booking::where('room_id', $id)
            ->where('status', BookingStatusEnum::ACTIVE)
            ->latest('id')->first();


        $rentContractSize = $currentBooking
            ? $this->storageService->getFileSizeMB(config('custom.rent_contract_path') . '/' . $currentBooking->rent_contract)
            : 0;

        return view('admins.rooms.show', [
            'room' => Room::findOrFail($id)->first(),
            'currentBooking' => $currentBooking,
            'rentContractSize' => $rentContractSize,
            'bookings' => Booking::with('user')->where('room_id', $id)
                ->latest('id')->paginate(20),
            'invoices' => Invoice::with(['room.floor.building', 'booking'])->where('room_id', $id)
                ->latest('id')->take(5)->get(),
            'repairs' => Repair::where('room_id', $id)->latest('id')->take(5)->get(),
            'utilityExpenses' => UtilityExpense::where('room_id', $id)->take(12)->get(),
        ]);
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

    /**
     * @param string $filename
     * @return StreamedResponse
     */
    public function downloadRentContract(string $filename): StreamedResponse
    {
        return $this->storageService->download(config('custom.rent_contract_path') . '/' . $filename);
    }
}
