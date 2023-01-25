@extends('layouts.admin')
@section('title', 'จัดการผู้เช่า ' . $user->full_name)
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        จัดการผู้เช่า - {{ $user->full_name }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                           class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                            แก้ไขข้อมูลผู้เช่า
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                           data-bs-target="#modal-report" aria-label="Create new report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-md-8">
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
                                    <div class="datagrid-content">{{ $user->id_card }}</div>
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
                                          class="badge bg-{{ \App\Enums\UserStatusEnum::getColor($user->status) }}">
                                                {{ \App\Enums\UserStatusEnum::getLabel($user->status) }}
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
                            <h3 class="card-title">เอกสารที่เกี่ยวข้อง</h3>
                        </div>
                        <div class="list-group list-group-flush overflow-auto" style="max-height: 35rem">
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">
                                            <svg style="color: red" xmlns="http://www.w3.org/2000/svg" width="16"
                                                 height="16" fill="currentColor" class="bi bi-file-pdf"
                                                 viewBox="0 0 16 16"> <path
                                                    d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"
                                                    fill="red"></path> <path
                                                    d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"
                                                    fill="red"></path> </svg>
                                        </span>
                                    </div>
                                    <div class="col text-truncate">
                                        <a href="{{ route('admin.users.download.idcardcopy', ['filename' => $user->id_card_copy]) }}"
                                           class="text-body d-block">
                                            สำเนาบัตรประชาชน
                                        </a>
                                        <div class="text-muted text-truncate mt-n1">
                                            ขนาดไฟล์ {{  number_format($idCardCopySize, 2, '.', '') }} MB
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">
                                            <svg style="color: red" xmlns="http://www.w3.org/2000/svg" width="16"
                                                 height="16" fill="currentColor" class="bi bi-file-pdf"
                                                 viewBox="0 0 16 16"> <path
                                                    d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"
                                                    fill="red"></path> <path
                                                    d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"
                                                    fill="red"></path> </svg>
                                        </span>
                                    </div>
                                    <div class="col text-truncate">
                                        <a href="{{ route('admin.users.download.housecopy', ['filename' => $user->copy_house_registration]) }}"
                                           class="text-body d-block">
                                            สำเนาทะเบียนบ้าน
                                        </a>
                                        <div class="text-muted text-truncate mt-n1">
                                            ขนาดไฟล์ {{  number_format($copyHouseRegSize, 2, '.', '') }} MB
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <h3 class="card-header">รายการห้องที่พัก</h3>
                        <div class="card-table table-responsive">
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
                                            <a href="#">
                                                ตึก {{ $booking->room->floor->building->name }}
                                                ชั้น {{ $booking->room->floor->name }}
                                                ห้อง {{ $booking->room->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-{{ \App\Enums\BookingStatusEnum::getColor($booking->status) }}">
                                                {{ \App\Enums\BookingStatusEnum::getLabel($booking->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#!" class="btn btn-sm">แก้ไข</a>
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
                <div class="col-8">
                    <div class="card">
                        <h3 class="card-header">หมายเลขใบแจ้งหนี้</h3>
                        <div class="card-table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
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
                                                #{{ $invoice->id }}
                                            </a>

                                        </td>
                                        <td>
                                            ตึก {{ $invoice->booking->room->floor->building->name }}
                                            ชั้น {{ $invoice->booking->room->floor->name }}
                                            ห้อง {{ $invoice->booking->room->name }}
                                        </td>
                                        <td>
                                            @if ($invoice->due_date_status && $invoice->status == \App\Enums\InvoiceStatusEnum::PENDING)
                                                <span class="badge bg-red">
                                                {{ \App\Enums\InvoiceStatusEnum::getLabel(\App\Enums\InvoiceStatusEnum::OVERDUE) }}
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-{{ \App\Enums\InvoiceStatusEnum::getColor($invoice->status) }}">
                                                {{ \App\Enums\InvoiceStatusEnum::getLabel($invoice->status) }}
                                                </span>
                                            @endif

                                        </td>
                                        <td>
                                            {{ $invoice->cycle_date }}
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
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <h3 class="card-header">รายการแจ้งซ่อม</h3>
                        <div class="card-table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>เรื่อง</th>
                                    <th>สถานะ</th>
                                    <th>วันที่แจ้ง</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($repairs as $repair)
                                    <tr>
                                        <td>
                                            <a href="#">
                                                #{{ $repair->id }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $repair->subject }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-{{ \App\Enums\RepairStatusEnum::getColor($repair->status) }}">
                                                {{ \App\Enums\RepairStatusEnum::getLabel($repair->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $repair->created_at }}
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
            </div>
        </div>
    </div>
@endsection
