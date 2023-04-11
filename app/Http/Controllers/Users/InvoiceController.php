<?php

namespace App\Http\Controllers\Users;

use App\Enums\BookingStatusEnum;
use App\Enums\InvoiceStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentUploadRequest;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Payment;
use App\Services\StorageService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function __construct(private readonly StorageService $storageService)
    {
    }

    public function index(Request $request): View
    {
        // Filter Status
        $status = $request->query('status');
        $month = $request->query('month', 0);
        $year = $request->query('year', 0);
        $room = $request->query('room', 0);

        $dateNow = now();

        $invoices = Invoice::with(['user', 'payment', 'room.floor.building'])
            // Filter Status
            ->where('user_id', auth()->user()->id)
            ->when(!empty($status), function (Builder $query) use ($status, $dateNow) {
                $query->where(function ($query) use ($status, $dateNow) {
                    // Query PENDING
                    $query->when(in_array(InvoiceStatusEnum::PENDING->value, $status), function (Builder $query) use ($dateNow) {
                        $query->orWhere(function () use ($query, $dateNow) {
                            $query->orWhereDate('due_date', '>', $dateNow);
                            $query->where('status', InvoiceStatusEnum::PENDING->value);
                        });
                    });
                    // Query OVERDUE
                    $query->when(in_array(InvoiceStatusEnum::OVERDUE->value, $status), function (Builder $query) use ($dateNow) {
                        $query->orWhere(function () use ($query, $dateNow) {
                            $query->orWhereDate('due_date', '<', $dateNow);
                            $query->where('status', InvoiceStatusEnum::PENDING->value);
                        });
                    });
                    // Query COMPLETE
                    $query->when(in_array(InvoiceStatusEnum::COMPLETE->value, $status), function (Builder $query) {
                        $query->orWhere('status', InvoiceStatusEnum::COMPLETE);
                    });
                    // Query CANCEL
                    $query->when(in_array(InvoiceStatusEnum::CANCEL->value, $status), function (Builder $query) {
                        $query->orWhere('status', InvoiceStatusEnum::CANCEL);
                    });
                });
            })
            ->when($month > 0, function (Builder $query) use ($month) {
                $query->whereMonth('cycle', $month);
            })
            ->when($year > 0, function (Builder $query) use ($year) {
                $query->whereYear('cycle', $year);
            })
            ->when($room > 0, function (Builder $query) use ($room) {
                $query->where('room_id', $room);
            })
            ->latest('cycle')
            ->paginate(50)
            ->withQueryString();

        return view('users.invoices.index', [
            'bookings' => Booking::with(['room.floor.building'])
                ->where('user_id', auth()->user()->id)
                ->where('status', BookingStatusEnum::ACTIVE)
                ->get(),
            'invoices' => $invoices,
        ]);
    }

    public function show(string $id): View
    {
        $invoice = Invoice::with([
            'user',
            'room.floor.building',
            'room.configuration',
        ])->findOrFail($id);

        // Check user permission
        Gate::authorize('view', $invoice);

        return view('users.invoices.show', [
            'invoice' => $invoice,
            'payment' => $invoice->payment()
                ->with(['user', 'invoice'])
                ->latest()
                ->first(),
        ]);
    }

    public function createPayment(PaymentUploadRequest $request, string $invoiceId): RedirectResponse
    {
        $invoice = Invoice::findOrFail($invoiceId);

        // Check user permission
        Gate::authorize('createPayment', $invoice);

        $filename = $request->file('slip')->hashName();

        $request->file('slip')->storeAs(
            config('custom.payment_attachment_path'),
            $filename
        );

        DB::transaction(function () use ($invoice, $filename) {
            Payment::create([
                'attachfile' => $filename,
                'user_id' => auth()->user()->id,
                'invoice_id' => $invoice->id,
                'status' => PaymentStatusEnum::PENDING,
            ]);

            // Stamp overdue and summary
            $invoice->update([
                'overdue_total' => $invoice->dynamic_overdue_total,
                'summary' => $invoice->dynamic_summary,
            ]);
        });

        return redirect()->back()->with('แจ้งชำระเงินสำเร็จ');
    }

    public function updatePayment(PaymentUploadRequest $request, string $invoiceId): RedirectResponse
    {
        $invoice = Invoice::findOrFail($invoiceId);

        // Check user permission
        Gate::authorize('updatePayment', $invoice);

        $payment = $invoice->payment()->first();

        $filename = $request->file('slip')->hashName();

        // upload new slip
        $request->file('slip')->storeAs(
            config('custom.payment_attachment_path'),
            $filename
        );

        // Remove old slip
        $this->storageService->removeFile(
            config('custom.payment_attachment_path') . '/' . $payment->attachfile
        );

        DB::transaction(function () use ($payment, $invoice, $filename) {
            $payment->update([
                'attachfile' => $filename,
                'status' => PaymentStatusEnum::PENDING,
            ]);

            // Stamp overdue and summary
            $invoice->update([
                'overdue_total' => $invoice->dynamic_overdue_total,
                'summary' => $invoice->dynamic_summary,
            ]);
        });

        return redirect()->back()->with('แจ้งชำระเงินสำเร็จ');
    }

    public function downloadReceipt(string $id)
    {
        $invoice = Invoice::findOrFail($id);

        // Check user permission
        Gate::authorize('downloadReceipt', $invoice);

        $pdf = Pdf::loadView('pdfs.receipt', ['invoice' => $invoice]);

        return $pdf->stream(now() . '.pdf');
    }
}
