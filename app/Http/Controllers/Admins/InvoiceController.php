<?php

namespace App\Http\Controllers\Admins;

use App\Enums\InvoiceStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentEditRequest;
use App\Models\Invoice;
use App\Models\Payment;
use App\Services\InvoiceService;
use App\Services\RoomService;
use App\Services\StorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{

    /**
     * @param StorageService $storageService
     * @param InvoiceService $invoiceService
     */
    public function __construct(
        private readonly StorageService $storageService,
        private readonly InvoiceService $invoiceService,
        private readonly RoomService    $roomService,
    )
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $status = $request->query('status', InvoiceStatusEnum::cases());
        $month = $request->query('month', 0);
        $year = $request->query('year', 0);
        $room = $request->query('room', 0);

        $invoices = Invoice::with('user', 'payments', 'room.floor.building')
            ->whereIn('status', $status);

        if ($month > 0) {
            $invoices->whereMonth('cycle', $month);
        }

        if ($year > 0) {
            $invoices->whereYear('cycle', $year);
        }

        if ($room > 0) {
            $invoices->where('room_id', $room);
        }

        return view('admins.invoices.index', [
            'invoices' => $invoices->latest('id')->paginate(40),
            'rooms' => $this->roomService->getRooms(),
        ]);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        return view('admins.invoices.edit', [
            'invoice' => Invoice::with(['user', 'room.floor.building' => function ($query) {
                $query->first();
            }])->findOrFail($id),
            'payment' => Payment::where('invoice_id', $id)->latest()->first(),
        ]);
    }

    /**
     * @param PaymentEditRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PaymentEditRequest $request, $id)
    {
        DB::transaction(function () use ($id, $request) {

            Payment::where('invoice_id', $id)->latest()->update($request->validated());

            $this->invoiceService->updateInvoiceComplete($request, $id);

        });

        return redirect()->back()->with(['success' => 'ดำเนินการแก้ไขสถานะสำเร็จ']);
    }

    /**
     * @param string $filename
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function downloadPaymentAttach(string $filename)
    {
        return $this->storageService->viewFile(config('custom.payment_attachment_path') . '/' . $filename);
    }
}
