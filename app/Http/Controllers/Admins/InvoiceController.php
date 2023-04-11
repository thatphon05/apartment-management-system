<?php

namespace App\Http\Controllers\Admins;

use App\Enums\InvoiceStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceCreateRequest;
use App\Http\Requests\InvoiceUpdateRequest;
use App\Http\Requests\PaymentEditRequest;
use App\Models\Invoice;
use App\Services\InvoiceService;
use App\Services\RoomService;
use App\Services\StorageService;
use Barryvdh\DomPDF\Facade\Pdf;
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

    /**
     * Update invoice status from button on right top the page.
     */
    public function update(InvoiceUpdateRequest $request, string $id): RedirectResponse
    {
        DB::transaction(function () use ($id, $request) {
            $invoice = Invoice::findOrFail($id);

            // Update status to complete (available when no payment associate) then stamp due date and summary
            if (InvoiceStatusEnum::from($request->status) === InvoiceStatusEnum::COMPLETE) {
                $this->invoiceService->setInvoiceStatusComplete($invoice);
            }

            // Update payment when click cancel invoice on top page
            if (InvoiceStatusEnum::from($request->status) === InvoiceStatusEnum::CANCEL) {
                // Set invoice status to cancel and stamp 0 in due date and total
                $this->invoiceService->setInvoiceStatusCancel($invoice);
            }
        });

        return to_route('admin.invoices.show', ['invoice' => $id]);
    }

    public function downloadPaymentAttach(string $filename): Response
    {
        return $this->storageService->viewFile(
            $filename, config('custom.payment_attachment_path')
        );
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
        $invoice = Invoice::with([
            'user',
            'room.floor.building',
            'room.configuration',
        ])->findOrFail($id);

        return view('admins.invoices.show', [
            'invoice' => $invoice,
            'payment' => $invoice->payment()
                ->with(['user', 'invoice'])
                ->latest()
                ->first(),
        ]);
    }

    /**
     * Update status from payment
     */
    public function updatePayment(PaymentEditRequest $request, string $id): RedirectResponse
    {
        DB::transaction(function () use ($id, $request) {
            $this->invoiceService->updateInvoiceStatus($request, $id);
        });

        return to_route('admin.invoices.show', ['invoice' => $id])
            ->with(['success' => 'ดำเนินการแก้ไขสถานะสำเร็จ']);
    }

    public function downloadReceipt(string $id): Response
    {
        $invoice = Invoice::where('id', $id)
            ->where('status', InvoiceStatusEnum::COMPLETE)
            ->firstOrFail();

        $pdf = Pdf::loadView('pdfs.receipt', ['invoice' => $invoice]);

        return $pdf->stream(now() . '.pdf');
    }
}
