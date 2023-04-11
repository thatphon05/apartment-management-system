@extends('layouts.user')
@section('title', 'รายการใบแจ้งหนี้')
@section('breadcrumb', Breadcrumbs::render('user.invoice'))
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        รายการใบแจ้งหนี้
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
                            <form action="{{ route('user.invoices.index') }}" method="get"
                                  onsubmit="submitButton.disabled = true;
                                        submitButton.classList.add('btn-loading');
                                        return true;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <div class="form-label">เลือกเดือน</div>
                                            <select name="month" class="form-select">
                                                <option value="0" selected>ทั้งหมด</option>
                                                @foreach(getAllMonth() as $month)
                                                    <option value="{{ $loop->iteration }}"
                                                        @selected(request()->query('month') == $loop->iteration)>
                                                        {{ $month }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <div class="form-label">เลือกปี</div>
                                            <select name="year" class="form-select">
                                                <option value="0" selected>ทั้งหมด</option>
                                                @for($year = \Carbon\Carbon::now()->year; $year >= 2018; $year--)
                                                    <option
                                                        value="{{ $year }}" @selected(request()->query('year') == $year)>{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <div class="form-label">เลือกห้อง</div>
                                            <select name="room" class="form-select">
                                                <option value="0" selected>ทั้งหมด</option>
                                                @foreach($bookings as $booking)
                                                    <option value="{{ $booking->room->id }}"
                                                        @selected(request()->query('room') == $booking->room->id)
                                                        @selected(old('room') == $booking->room->id)
                                                    >
                                                        อาคาร {{ $booking->room->floor->building->name }}
                                                        ชั้น {{ $booking->room->floor->name }}
                                                        ห้อง {{ $booking->room->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">สถานะใบแจ้งหนี้</div>
                                    @include('partials.admins.checkbox_status', ['enum' => InvoiceStatusEnum::class])
                                </div>
                                <button type="submit" class="btn btn btn-primary" role="button" name="submitButton">
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
                                    <a href="{{ route('user.invoices.index') }}" class="btn btn-ghost-danger"
                                       role="button">ยกเลิกตัวกรอง</a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">รายการใบแจ้งหนี้</h3>
                        </div>
                        <div class="card-table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#ใบแจ้งหนี้</th>
                                    <th>ห้อง</th>
                                    <th>สถานะ</th>
                                    <th>ประจำเดือน</th>
                                    <th>วันครบกำหนดชำระ</th>
                                    <th>การแจ้งชำระเงิน</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($invoices as $invoice)
                                    <tr>
                                        <td>
                                            <a href="#">
                                                <a href="{{ route('user.invoices.show', ['invoice' => $invoice->id]) }}">
                                                    #{{ $invoice->id }}
                                                </a>
                                            </a>
                                        </td>
                                        <td>
                                            อาคาร {{ $invoice->room->floor->building->name }}
                                            ชั้น {{ $invoice->room->floor->name }}
                                            ห้อง {{ $invoice->room->name }}
                                        </td>
                                        <td>
                                            @if($invoice->is_due_date && $invoice->status == InvoiceStatusEnum::PENDING)
                                                <span class="badge bg-red">
                                {{ InvoiceStatusEnum::getLabel(InvoiceStatusEnum::OVERDUE) }}
                            </span>
                                            @else
                                                <span
                                                    class="badge bg-{{ InvoiceStatusEnum::getColor($invoice->status) }}">
                                {{ InvoiceStatusEnum::getLabel($invoice->status) }}
                            </span>
                                            @endif

                                        </td>
                                        <td>
                                            {{ $invoice->cycle_month }}
                                        </td>
                                        <td>
                                            {{ $invoice->due_date_format }}
                                        </td>
                                        @php
                                            $statusColor = '';
                                            if ($invoice->status === InvoiceStatusEnum::COMPLETE)
                                               $statusColor = PaymentStatusEnum::getColor(PaymentStatusEnum::COMPLETE);
                                            else if($invoice->payment === null)
                                                $statusColor = 'red';
                                            else
                                                $statusColor = PaymentStatusEnum::getColor($invoice->payment->status);
                                        @endphp
                                        <td class="text-{{ $statusColor }}">
                                            @if ($invoice->status === InvoiceStatusEnum::COMPLETE)
                                                {{ PaymentStatusEnum::getLabel(PaymentStatusEnum::COMPLETE) }}
                                            @elseif($invoice->payment === null)
                                                ยังไม่ได้แจ้งชำระเงิน
                                            @else
                                                {{ PaymentStatusEnum::getLabel($invoice->payment->status) }}
                                            @endif
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
                        <div class="card-footer pb-0">
                            <div class="m-0 ms-auto">
                                {{ $invoices->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
