<?php

namespace App\Http\Controllers\Admins;

use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentEditRequest;
use App\Models\Payment;
use App\Services\InvoiceService;
use App\Services\StorageService;

class PaymentController extends Controller
{

    public function __construct(
        private StorageService $storageService,
        private InvoiceService $invoiceService)
    {
    }

    public function index()
    {
        $status = request()->query('status', UserStatusEnum::cases());
        return view('admins.payments.index', [
            'payments' => Payment::with(['user', 'invoice'])->whereIn('status', $status)
                ->latest()
                ->paginate(40),
        ]);
    }

    public function edit($id)
    {
        return view('admins.payments.edit', [
            'payment' => Payment::with(['user', 'booking.room.floor.building' => function ($query) {
                $query->first();
            }])->findOrFail($id),
        ]);
    }

    public function update(PaymentEditRequest $request, $id)
    {
        $payment = Payment::where('id', $id)->update($request->validated());

        $this->invoiceService->updateInvoiceComplete($request, $id);

        return redirect()->back();
    }

    /**
     * @param string $filename
     */
    public function downloadPaymentAttach(string $filename)
    {
        return $this->storageService->viewFile(config('custom.payment_attachment_path') . '/' . $filename);
    }
}
