<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentEditRequest;
use App\Models\Invoice;
use App\Models\Payment;
use App\Services\InvoiceService;
use App\Services\RoomService;
use App\Services\StorageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InvoiceController extends Controller
{

    public function __construct(
        private readonly StorageService $storageService,
        private readonly InvoiceService $invoiceService,
        private readonly RoomService    $roomService,
    )
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('admins.invoices.index', [
            'invoices' => $this->invoiceService->searchInvoice($request),
            'rooms' => $this->roomService->getRooms(),
        ]);
    }

    public function edit(string $id): View
    {
        return view('admins.invoices.edit', [
            'invoice' => Invoice::with(['user', 'room.floor.building' => function ($query) {
                $query->first();
            }])->findOrFail($id),
            'payment' => Payment::where('invoice_id', $id)->latest()->first(),
        ]);
    }

    public function update(PaymentEditRequest $request, string $id): RedirectResponse
    {
        DB::transaction(function () use ($id, $request) {

            Payment::where('invoice_id', $id)->latest()->update($request->validated());

            $this->invoiceService->updateInvoiceStatus($request, $id);

        });

        return redirect()->back()->with(['success' => 'ดำเนินการแก้ไขสถานะสำเร็จ']);
    }

    public function downloadPaymentAttach(string $filename): Response
    {
        return $this->storageService->viewFile(config('custom.payment_attachment_path') . '/' . $filename);
    }
}
