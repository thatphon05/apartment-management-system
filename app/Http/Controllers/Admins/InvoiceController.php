<?php

namespace App\Http\Controllers\Admins;

use App\Enums\InvoiceStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceCreateRequest;
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

    public function index(Request $request): View
    {
        return view('admins.invoices.index', [
            'invoices' => $this->invoiceService->searchInvoice($request),
            'rooms' => $this->roomService->getRooms(),
        ]);
    }

    public function update(string $id): RedirectResponse
    {
        DB::transaction(function () use ($id) {

            Invoice::findOrFail($id)->update([
                'status' => InvoiceStatusEnum::CANCEL,
            ]);

            Payment::where('invoice_id', $id)->latest()->update([
                'status' => PaymentStatusEnum::CANCEL,
            ]);

        });

        return to_route('admin.invoices.show', ['invoice' => $id]);
    }

    public function downloadPaymentAttach(string $filename): Response
    {
        return $this->storageService->viewFile(config('custom.payment_attachment_path') . '/' . $filename);
    }

    public function create(): View
    {
        return view('admins.invoices.create', [
            'rooms' => $this->roomService->getRooms(),
        ]);
    }

    public function store(InvoiceCreateRequest $request): RedirectResponse
    {
        $invoice = $this->invoiceService->createInvoice($request->room_id, $request->cycle);

        return to_route('admin.invoices.show', ['invoice' => $invoice->id]);
    }

    public function show(string $id): View
    {
        return view('admins.invoices.show', [
            'invoice' => Invoice::with([
                'user',
                'room.floor.building',
                'room.configuration',
            ])->findOrFail($id),
            'payment' => Payment::where('invoice_id', $id)
                ->with(['booking.room.floor', 'user'])
                ->latest()
                ->first(),
        ]);
    }

    public function updatePayment(PaymentEditRequest $request, string $id): RedirectResponse
    {
        DB::transaction(function () use ($id, $request) {

            Payment::where('invoice_id', $id)->latest()->update($request->validated());

            $this->invoiceService->updateInvoiceStatus($request, $id);

        });

        return to_route('admin.invoices.show', ['invoice' => $id])
            ->with(['success' => 'ดำเนินการแก้ไขสถานะสำเร็จ']);
    }
}
