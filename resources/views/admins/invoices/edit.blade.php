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
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p class="h3">โทพาซ</p>
                                <address>
                                    Street Address<br>
                                    State, City<br>
                                    Region, Postal Code<br>
                                    ltd@example.com
                                </address>
                            </div>
                            <div class="col-6 text-end">
                                <p class="h3">Client</p>
                                <address>
                                    {{ $invoice->user->full_name }} <br>
                                    {{ $invoice->user->full_address }}
                                </address>
                            </div>
                            <div class="col-12 my-5">
                                <h1>
                                    ใบแจ้งหนี้ #{{ $invoice->id }}
                                    อาคาร {{ $invoice->room->floor->building->name ?? '' }}
                                    ชั้น {{ $invoice->room->floor->name ?? '' }}
                                    ห้อง {{ $invoice->room->name ?? '' }}
                                </h1>
                            </div>
                        </div>
                        <table class="table table-transparent table-responsive">
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
                                    <p class="strong mb-1">ค่าเช่าห้อง</p>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-end">{{ $invoice->rent_total }}</td>
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
                                <td class="text-end">{{ $invoice->common_total }}</td>
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
                                <td class="text-end">{{ $invoice->parking_total }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">8</td>
                                <td>
                                    <p class="strong mb-1">ค่าปรับชำระเลยกำหนด</p>
                                    <div class="text-muted">หากชำระเงินเกินวันที่ {{ $invoice->due_date_format }}
                                        จะเสียค่าปรับวันละ {{ $invoice->room->configuration->overdue_fee }} บาท
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
                        <div class="card mt-5">
                            <div class="card-header">
                                <h4 class="card-title">ปรับรายการชำระเงิน</h4>
                            </div>
                            <div class="card-body">
                                @if($payment)
                                    <dl class="row">
                                        <dt class="col-3">หมายเลขแจ้งชำระเงิน</dt>
                                        <dd class="col-9">#{{$payment->id}}</dd>
                                        <dt class="col-3">หมายเลขใบแจ้งหนี้</dt>
                                        <dd class="col-9">
                                            <a href="#!">
                                                #{{$payment->invoice->id}}
                                            </a>
                                        </dd>
                                        <dt class="col-3">ห้อง</dt>
                                        <dd class="col-9">
                                            อาคาร {{ $payment->booking->room->name }}
                                            ชั้น {{ $payment->booking->room->floor->name }}
                                            ห้อง {{ $payment->booking->room->name }}
                                        </dd>
                                        <dt class="col-3">วันที่แจ้ง</dt>
                                        <dd class="col-9">{{$payment->created_at}}</dd>
                                        <dt class="col-3">ชื่อผู้แจ้ง</dt>
                                        <dd class="col-9">
                                            <a href="{{ route('admin.users.show', ['user' => $payment->user->id]) }}">
                                                {{ $payment->user->full_name }}
                                            </a>
                                        </dd>
                                        <dt class="col-3">สถานะ</dt>
                                        <dd class="col-9">
                                        <span
                                            class="badge bg-{{ \App\Enums\PaymentStatusEnum::getColor($payment->status) }}">
                                                {{ \App\Enums\PaymentStatusEnum::getLabel($payment->status) }}
                                        </span>
                                        </dd>
                                        <dt class="col-3">ไฟล์สลิปโอนเงิน</dt>
                                        <dd class="col-9">
                                            <a href="{{ route('admin.payments.download.payment_attach', ['filename' => $payment->attachfile]) }}"
                                               target="_blank">
                                                ดูสลิป
                                            </a>
                                        </dd>
                                    </dl>
                                    <div class="row mt-4">
                                        <form action="{{ route('admin.invoices.update', ['invoice' => $invoice->id]) }}"
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


