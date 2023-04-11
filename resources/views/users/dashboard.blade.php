@extends('layouts.user')
@section('title', 'หน้าแรก')
@section('breadcrumb', Breadcrumbs::render('user.dashboard'))
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        ข้อมูลส่วนตัว - {{ $user->full_name }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">ชื่อ - นามสกุล</div>
                                    <div class="datagrid-content">{{ $user->full_name }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">อีเมล</div>
                                    <div class="datagrid-content">{{ $user->email }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">เบอร์โทรศัพท์</div>
                                    <div class="datagrid-content">{{ $user->telephone }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">รหัสบัตรประชาชน</div>
                                    <div class="datagrid-content">{{ $user->id_card_number }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">วันเกิด</div>
                                    <div class="datagrid-content">
                                        {{ $user->birth_date_format }}
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">อายุ</div>
                                    <div class="datagrid-content">{{ $user->age }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">สถานะ</div>
                                    <div class="datagrid-content">
                                      <span
                                          class="badge bg-{{ UserStatusEnum::getColor($user->status) }}">
                                                {{ UserStatusEnum::getLabel($user->status) }}
                                      </span>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">ที่อยู่</div>
                                    <div class="datagrid-content">
                                        {{ $user->full_address }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">รายการห้องที่เช่า</h3>
                        </div>
                        <div class="card-table table-responsive overflow-auto" style="max-height: 300px">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ห้อง</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($bookings as $booking)
                                    <tr>
                                        <td>
                                            <a href="{{ route('user.bookings.show', ['booking' => $booking->id]) }}">
                                                อาคาร {{ $booking->room->floor->building->name }}
                                                ชั้น {{ $booking->room->floor->name }}
                                                ห้อง {{ $booking->room->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-{{ BookingStatusEnum::getColor($booking->status) }}">
                                                {{ BookingStatusEnum::getLabel($booking->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('user.bookings.show', ['booking' => $booking->id]) }}"
                                               class="btn btn-sm">ดู</a>
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
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">รายการใบแจ้งหนี้ที่ยังไม่ชำระเงิน</h3>
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
                        <div class="card-footer text-center">
                            <a href="{{ route('user.invoices.index', [
                                        'status[0]' => InvoiceStatusEnum::PENDING,
                                        'status[1]' => InvoiceStatusEnum::OVERDUE
                                        ])
                                     }}
                                ">
                                ดูทั้งหมด
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
