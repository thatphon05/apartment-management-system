@extends('layouts.user')
@section('title', 'ใบแจ้งหนี้ #' . $invoice->id)
@section('breadcrumb', Breadcrumbs::render('user.invoice-show', $invoice))
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            ใบแจ้งหนี้ #{{ $invoice->id }}
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            @if($invoice->status === InvoiceStatusEnum::COMPLETE)
                                <a href="{{ route('user.invoices.download-receipt', ['invoice' => $invoice->id]) }}"
                                   onclick="loadingButton(this)"
                                   class="btn btn-success d-sm-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-download" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                        <path d="M7 11l5 5l5 -5"></path>
                                        <path d="M12 4l0 12"></path>
                                    </svg>
                                    ดาวน์โหลดใบเสร็จ
                                </a>
                            @else
                                <button class="btn btn-success d-sm-inline-block" onclick="window.print()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor" fill="none" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                        <path
                                            d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                                    </svg>
                                    พิมพ์ใบแจ้งหนี้
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card card-lg">
                    <div class="card-body">
                        @include('partials.invoice', ['invoice' => $invoice])
                        <div class="card mt-5 d-print-none">
                            <div class="card-header row align-items-center">
                                <div class="col-auto fs-3">
                                    <h2>อัพโหลดหลักฐานการชำระเงิน</h2>
                                </div>
                            </div>
                            <div class="card-body">
                                @if($payment)
                                    <dl class="row">
                                        <dt class="col-3">หมายเลขแจ้งชำระเงิน:</dt>
                                        <dd class="col-9">#{{$payment->id}}</dd>
                                        <dt class="col-3">หมายเลขใบแจ้งหนี้:</dt>
                                        <dd class="col-9">
                                            <a href="#!">
                                                #{{$payment->invoice->id}}
                                            </a>
                                        </dd>
                                        <dt class="col-3">วันและเวลาที่แจ้ง:</dt>
                                        <dd class="col-9">{{$payment->created_at}}</dd>
                                        <dt class="col-3">ชื่อผู้แจ้ง:</dt>
                                        <dd class="col-9">
                                            {{ $payment->user->full_name }}
                                        </dd>
                                        <dt class="col-3">สถานะ:</dt>
                                        <dd class="col-9">
                                        <span
                                            class="badge bg-{{ PaymentStatusEnum::getColor($payment->status) }}">
                                                {{ PaymentStatusEnum::getLabel($payment->status) }}
                                        </span>
                                        </dd>
                                        <dt class="col-3">ไฟล์สลิปโอนเงิน:</dt>
                                        <dd class="col-9">
                                            <a data-bs-toggle="modal" data-bs-target="#modal-payment" href=""
                                               style="cursor: zoom-in;">
                                                <img class="img-fluid img-responsive-3x4 img-thumbnail rounded"
                                                     style="max-width: 200px"
                                                     src="{{ route('admin.payments.download.payment-attach', ['filename' => $payment->attachfile]) }}">
                                            </a>
                                            <div class="modal" tabindex="-1" id="modal-payment">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content text-center">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">ไฟล์สลิปโอนเงิน</h5>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img
                                                                class="img-fluid img-responsive-3x4 img-thumbnail rounded"
                                                                src="{{ route('admin.payments.download.payment-attach', ['filename' => $payment->attachfile]) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </dd>
                                    </dl>
                                    <div class="row mt-4">
                                        @if ($payment->status === PaymentStatusEnum::CANCEL)
                                            <p class="text-red">*ถูกปฏิเสธการชำระเงินกรุณาแนบสลิปใหม่</p>
                                            <form
                                                action="{{ route('user.invoices.payment.update', ['invoice' => $invoice->id]) }}"
                                                method="post"
                                                enctype="multipart/form-data"
                                                onsubmit="submitButton.disabled = true;
                                                            submitButton.classList.add('btn-loading');
                                                            return true;">
                                                @csrf
                                                <div class="mb-3 mt-3">
                                                    <label for="formFile" class="form-label">สลิป
                                                        (.jpg, png, jpeg)</label>
                                                    <input name="slip" onchange="inputChange(event)"
                                                           class="form-control @error('slip') is-invalid @enderror"
                                                           type="file" accept="image/*">
                                                    @error('slip')
                                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    <button type="submit" class="mt-3 btn btn-primary"
                                                            name="submitButton">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="icon icon-tabler icon-tabler-upload" width="24"
                                                             height="24" viewBox="0 0 24 24" stroke-width="2"
                                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                                            <path d="M7 9l5 -5l5 5"></path>
                                                            <path d="M12 4l0 12"></path>
                                                        </svg>
                                                        อัพโหลด
                                                    </button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                @elseif ($invoice->status === InvoiceStatusEnum::PENDING)
                                    <form
                                        action="{{ route('user.invoices.payment.create', ['invoice' => $invoice->id]) }}"
                                        method="post"
                                        enctype="multipart/form-data"
                                        onsubmit="submitButton.disabled = true;
                                            submitButton.classList.add('btn-loading');
                                            return true;">
                                        @csrf
                                        <div class="mb-3 mt-3">
                                            <label for="formFile" class="form-label">สลิป
                                                (.jpg, png, jpeg)</label>
                                            <input name="slip" onchange="inputChange(event)"
                                                   class="form-control @error('slip') is-invalid @enderror"
                                                   type="file" accept="image/*">
                                            @error('slip')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            <button type="submit" class="mt-3 btn btn-primary"
                                                    name="submitButton">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-upload" width="24"
                                                     height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                                    <path d="M7 9l5 -5l5 5"></path>
                                                    <path d="M12 4l0 12"></path>
                                                </svg>
                                                อัพโหลด
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    @include('partials.empty')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


