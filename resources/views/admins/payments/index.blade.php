@extends('layouts.admin')
@section('title', 'จัดการรายการแจ้งชำระเงิน')
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        จัดการรายการแจ้งชำระเงิน
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.payments.index') }}" method="get">
                                <div class="mb-3">
                                    <div class="form-label">สถานะแจ้งชำระเงิน</div>
                                    @include('partials.admins.checkbox_status', ['enum' => \App\Enums\PaymentStatusEnum::class])
                                </div>
                                <button type="submit" class="btn btn btn-primary" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="10" cy="10" r="7"></circle>
                                        <line x1="21" y1="21" x2="15" y2="15"></line>
                                    </svg>
                                    ค้นหา
                                </button>
                                @if (request()->has('status'))
                                    <a href="{{ route('admin.payments.index') }}" class="btn btn btn-danger"
                                       role="button">ยกเลิกการกรอง</a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            รายการแจ้งชำระเงิน
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ผู้แจ้ง</th>
                                    <th>หมายเลขใบแจ้งหนี้</th>
                                    <th>สถานะ</th>
                                    <th>วันที่แจ้งชำระ</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($payments as $payment)
                                    <tr>
                                        <td>
                                            <span class="text-muted">
                                            <a href="{{ route('admin.payments.edit', ['payment'=> $payment->id]) }}">
                                                    #{{ $payment->id }}
                                            </a>
                                            </span>
                                        </td>
                                        <td><span class="text-muted">{{ $payment->user->full_name }}</span></td>
                                        <td>
                                            #{{ $payment->invoice->id }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-{{ \App\Enums\PaymentStatusEnum::getColor($payment->status) }}">
                                                {{ \App\Enums\PaymentStatusEnum::getLabel($payment->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $payment->created_at }}</td>
                                        <td class="">
                                            <a href="{{ route('admin.payments.edit', ['payment' => $payment->id]) }}"
                                               class="btn"
                                               role="button">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-eye" width="24" height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <circle cx="12" cy="12" r="2"></circle>
                                                    <path
                                                        d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                                                </svg>
                                                ดูข้อมูล
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            @include('partials.empty')
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <div class="m-0 ms-auto">
                                {{ $payments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
