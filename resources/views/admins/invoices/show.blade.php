@extends('layouts.admin')
@section('title', 'ใบแจ้งหนี้ #' . $invoice->id)
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
                    @if($invoice->status == \App\Enums\InvoiceStatusEnum::PENDING)
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a data-bs-toggle="modal" data-bs-target="#modal-danger"
                               class="btn btn-danger d-none d-sm-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M18 6l-12 12"></path>
                                    <path d="M6 6l12 12"></path>
                                </svg>
                                ยกเลิกใบแจ้งหนี้
                            </a>
                            <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog"
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
                                                              action="{{ route('admin.invoices.update', ['invoice' => $invoice->id]) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-danger w-100"
                                                                    data-bs-dismiss="modal">
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
                        <div class="row text-end mb-3">
                            <h1>ใบแจ้งหนี้ #{{ $invoice->id }}</h1>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="h3">โทพาซ</p>
                                <address>
                                    20/20 ม.2 ถ.กิ่งแก้ว<br>
                                    ต.ราชาเทวะ อ.บางพลี<br>
                                    จ.สมุทรปราการ
                                </address>
                            </div>
                            <div class="col-6 text-end">
                                <p class="h3">ผู้เช่า</p>
                                <address>
                                    {{ $invoice->user->full_name }} <br>
                                    {{ $invoice->user->full_address }}
                                </address>
                            </div>
                            <div class="col-12 mt-1 mb-4 text-end border-top p-3 border-bottom">
                                <h4>
                                    สถานะ: <span
                                        class="badge bg-{{ \App\Enums\InvoiceStatusEnum::getColor($invoice->status) }}">
                                                {{ \App\Enums\InvoiceStatusEnum::getLabel($invoice->status) }}
                                        </span>
                                </h4>
                                <h4>
                                    อาคาร: {{ $invoice->room->floor->building->name ?? '' }}
                                    ชั้น: {{ $invoice->room->floor->name ?? '' }}
                                    ห้อง: {{ $invoice->room->name ?? '' }}
                                </h4>
                                <h4>
                                    วันที่สร้าง: {{ $invoice->created_at->translatedFormat('d F Y') }}
                                </h4>
                                <h4>
                                    ประจำเดือน: {{ $invoice->cycle_date }}
                                </h4>
                                <h4>
                                    ครบกำหนดชำระ: {{ $invoice->due_date_format }}
                                </h4>
                            </div>
                        </div>
                        <table class="table border table-responsive">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 1%"></th>
                                <th>รายการ</th>
                                <th class="text-center" style="width: 1%">เลขครั้งก่อน</th>
                                <th class="text-end" style="width: 1%">เลขครั้งหลัง</th>
                                <th class="text-end" style="width: 1%">หน่วย</th>
                                <th class="text-end" style="width: 1%">หน่วยละ</th>
                                <th class="text-end" style="width: 1%">จำนวนเงิน (บาท)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    <p class="strong mb-1">ค่าน้ำประปา</p>
                                </td>
                                <td class="text-center">{{ $invoice->water_unit_last }}</td>
                                <td class="text-center">{{ $invoice->water_unit_later }}</td>
                                <td class="text-center">{{ $invoice->water_unit }}</td>
                                <td class="text-center">{{ $invoice->water_unit_price }}</td>
                                <td class="text-end">{{ number_format($invoice->water_total_divided, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <p class="strong mb-1">ค่าใช้จ่ายในการให้บริการน้ำ</p>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center">{{ $invoice->water_unit }}</td>
                                <td class="text-center">{{ $invoice->water_unit_price }}</td>
                                <td class="text-end">{{ number_format($invoice->water_total_divided, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    <p class="strong mb-1">ค่าไฟฟ้า</p>
                                </td>
                                <td class="text-center">{{ $invoice->electric_unit_last }}</td>
                                <td class="text-center">{{ $invoice->electric_unit_later }}</td>
                                <td class="text-center">{{ $invoice->electric_unit }}</td>
                                <td class="text-center">{{ $invoice->electric_unit_price }}</td>
                                <td class="text-end">{{ number_format($invoice->electric_total_divided, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>
                                    <p class="strong mb-1">ค่าใช้จ่ายในการให้บริการไฟฟ้า</p>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center">{{ $invoice->electric_unit }}</td>
                                <td class="text-center">{{ $invoice->electric_unit_price }}</td>
                                <td class="text-end">{{ number_format($invoice->electric_total_divided, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td>
                                    <p class="strong mb-1">ค่าเช่าห้อง ({{ $invoice->cycle_date }})</p>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-end">{{ number_format($invoice->rent_total, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">6</td>
                                <td>
                                    <p class="strong mb-1">ค่าส่วนกลาง</p>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-end">{{ number_format($invoice->common_total, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">7</td>
                                <td>
                                    <p class="strong mb-1">ค่าจอดรถ</p>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-end">{{ number_format($invoice->parking_total, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">8</td>
                                <td>
                                    <p class="strong mb-1">ค่าปรับชำระเลยกำหนด</p>
                                    <div class="text-muted">หากชำระเงินเกินวันที่ {{ $invoice->due_date_format }}
                                        จะเสียค่าปรับวันละ {{ number_format($invoice->room->configuration->overdue_fee) }}
                                        บาท
                                        แต่ปรับไม่เกินวันที่ {{ $invoice->due_date_late }}
                                    </div>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-end">
                                    {{ number_format($invoice->overdue_total <= 0 ? $invoice->dynamic_overdue_total : $invoice->overdue_total, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" class="strong text-end">รวมทั้งสิ้น</td>
                                <td class="text-end">
                                    {{ number_format($invoice->summary <= 0 ? $invoice->dynamic_summary : $invoice->summary, 2) }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="card mt-5 d-print-none">
                            <div class="card-header">
                                <h4 class="card-title">ปรับรายการชำระเงิน</h4>
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
                                        <dt class="col-3">ห้อง:</dt>
                                        <dd class="col-9">
                                            อาคาร {{ $payment->booking->room->name }}
                                            ชั้น {{ $payment->booking->room->floor->name }}
                                            ห้อง {{ $payment->booking->room->name }}
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
                                            class="badge bg-{{ \App\Enums\PaymentStatusEnum::getColor($payment->status) }}">
                                                {{ \App\Enums\PaymentStatusEnum::getLabel($payment->status) }}
                                        </span>
                                        </dd>
                                        <dt class="col-3">ไฟล์สลิปโอนเงิน:</dt>
                                        <dd class="col-9">
                                            <a href="{{ route('admin.payments.download.payment_attach', ['filename' => $payment->attachfile]) }}"
                                               target="_blank">
                                                <img class="img-fluid img-responsive-3x4 img-thumbnail rounded"
                                                     style="max-width: 200px"
                                                     src="{{ route('admin.payments.download.payment_attach', ['filename' => $payment->attachfile]) }}">
                                            </a>
                                        </dd>
                                    </dl>
                                    <div class="row mt-4">
                                        <form
                                            action="{{ route('admin.payments.update', ['id' => $invoice->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PATCH')
                                            <div class="col-md-5">
                                                <select name="status"
                                                        class="form-select @error('status') is-invalid @enderror">
                                                    @foreach(\App\Enums\PaymentStatusEnum::values() as $key => $value)
                                                        <option
                                                            value="{{ $key }}" @selected(\App\Enums\PaymentStatusEnum::from($key) === $payment->status)>
                                                            {{ \App\Enums\PaymentStatusEnum::getLabel($value) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-primary">แก้ไข</button>
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


