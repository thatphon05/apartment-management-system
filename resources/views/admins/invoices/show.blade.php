@extends('layouts.admin')
@section('title', 'ใบแจ้งหนี้ #' . $invoice->id)
@section('breadcrumb', Breadcrumbs::render('admin.invoice-show', $invoice))
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
                    @if($invoice->status === InvoiceStatusEnum::PENDING)
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a data-bs-toggle="modal" data-bs-target="#cancel-invoice"
                                   class="btn btn-ghost-danger d-sm-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor"
                                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M18 6l-12 12"></path>
                                        <path d="M6 6l12 12"></path>
                                    </svg>
                                    ยกเลิกใบแจ้งหนี้
                                </a>
                                <div class="modal modal-blur fade" id="cancel-invoice" tabindex="-1" role="dialog"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            <div class="modal-status bg-danger"></div>
                                            <div class="modal-body text-center py-4">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon mb-2 text-danger icon-lg" width="24" height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M12 9v2m0 4v.01"/>
                                                    <path
                                                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"/>
                                                </svg>
                                                <h3>ยืนยันการยกเลิกใบแจ้งหนี้</h3>
                                                <div class="text-muted">
                                                    คุณต้องการยกเลิก ใบแจ้งหนี้ #{{ $invoice->id }} หรือไม่
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="w-100">
                                                    <div class="row">
                                                        <div class="col">
                                                            <a href="#" class="btn w-100"
                                                               data-bs-dismiss="modal">
                                                                ยกเลิก
                                                            </a>
                                                        </div>
                                                        <div class="col">
                                                            <form method="post"
                                                                  onsubmit="submitButton.disabled = true;
                                                                        submitButton.classList.add('btn-loading');
                                                                        return true;"
                                                                  action="{{ route('admin.invoices.update', ['invoice' => $invoice->id]) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status"
                                                                       value="{{ InvoiceStatusEnum::CANCEL }}">
                                                                <button type="submit" class="btn btn-danger w-100"
                                                                        name="submitButton">
                                                                    ยืนยัน
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                            </div>
                        </div>
                    @elseif($invoice->status === InvoiceStatusEnum::COMPLETE)
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="{{ route('admin.invoices.receipt', ['invoice' => $invoice->id]) }}"
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
                            </div>
                        </div>
                    @endif
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
                                    <h4>ปรับรายการชำระเงิน</h4>
                                </div>
                                @if($payment === null && $invoice->status !== InvoiceStatusEnum::COMPLETE && $invoice->status !== InvoiceStatusEnum::CANCEL)
                                    <div class="col-auto ms-auto">
                                        <a data-bs-toggle="modal" data-bs-target="#complete-invoice"
                                           class="btn btn-outline-success btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-check" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l5 5l10 -10"></path>
                                            </svg>
                                            ปรับเป็นชำระเงินแล้ว
                                        </a>
                                        <div class="modal modal-blur fade" id="complete-invoice" tabindex="-1"
                                             role="dialog"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    <div class="modal-status bg-warning"></div>
                                                    <div class="modal-body text-center py-4">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="icon mb-2 text-warning icon-lg" width="24"
                                                             height="24"
                                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M12 9v2m0 4v.01"/>
                                                            <path
                                                                d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"/>
                                                        </svg>
                                                        <h3 class="fw-bold">ยังไม่มีรายการชำระเงิน</h3>
                                                        <div class="text-muted">
                                                            คุณต้องการปรับใบแจ้งหนี้ #{{ $invoice->id }}
                                                            เป็นชำระเงินแล้วหรือไม่
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="w-100">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <a href="#" class="btn w-100"
                                                                       data-bs-dismiss="modal">
                                                                        ยกเลิก
                                                                    </a>
                                                                </div>
                                                                <div class="col">
                                                                    <form method="post"
                                                                          onsubmit="submitButton.disabled = true;
                                                                                submitButton.classList.add('btn-loading');
                                                                                return true;"
                                                                          action="{{ route('admin.invoices.update', ['invoice' => $invoice->id]) }}">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <input type="hidden" name="status"
                                                                               value="{{ InvoiceStatusEnum::COMPLETE }}">
                                                                        <button type="submit"
                                                                                class="btn btn-warning w-100"
                                                                                name="submitButton">
                                                                            ยืนยัน
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
                                            <a href="{{ route('admin.users.show', ['user' => $payment->user->id]) }}">
                                                {{ $payment->user->full_name }}
                                            </a>
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
                                        <form
                                            action="{{ route('admin.payments.update', ['id' => $invoice->id]) }}"
                                            onsubmit="submitButton.disabled = true;
                                                        submitButton.classList.add('btn-loading');
                                                        return true;"
                                            method="post">
                                            @csrf
                                            @method('PATCH')
                                            <div class="col-md-5">
                                                <label class="form-label">สถานะการชำระเงิน:</label>
                                                <select name="status"
                                                        class="form-select @error('status') is-invalid @enderror">
                                                    @foreach(PaymentStatusEnum::values() as $key => $value)
                                                        <option
                                                            value="{{ $key }}"
                                                            @selected(PaymentStatusEnum::from($key) === $payment->status)
                                                            @if (PaymentStatusEnum::from($key) === PaymentStatusEnum::PENDING
                                                                    && $payment->status !== PaymentStatusEnum::PENDING
                                                                )
                                                                disabled
                                                            @endif
                                                        >
                                                            {{ PaymentStatusEnum::getLabel($value) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-primary" name="submitButton">
                                                        แก้ไข
                                                    </button>
                                                    <a href="{{ route('admin.invoices.index') }}"
                                                       class="btn btn-ghost-secondary">ย้อนกลับ</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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


