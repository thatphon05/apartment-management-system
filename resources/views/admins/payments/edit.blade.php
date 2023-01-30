@extends('layouts.admin')
@section('title', 'รายการชำระเงิน #' . $payment->id)
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            รายการชำระเงิน #{{ $payment->id }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">รายการชำระเงิน</h4>
                            </div>
                            <div class="card-body">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('admin.payments.update', ['payment' => $payment->id]) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="card mt-2">
                                <div class="card-header">
                                    <h4 class="card-title">ปรับสถานะ</h4>
                                </div>
                                <div class="card-body">
                                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                                        @foreach(\App\Enums\PaymentStatusEnum::values() as $key => $value)
                                            <option
                                                value="{{ $key }}" @selected(\App\Enums\PaymentStatusEnum::from($key) === $payment->status)>
                                                {{ \App\Enums\PaymentStatusEnum::getLabel($value) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">แก้ไข</button>
                                    <a href="{{ route('admin.payments.index') }}"
                                       class="btn btn-ghost-secondary">ย้อนกลับ</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection


