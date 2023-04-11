@extends('layouts.admin')
@section('title', 'รายละเอียดการเช่า')
@section('breadcrumb', Breadcrumbs::render('admin.booking-show', $booking))
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        รายละเอียดการเช่า
                        อาคาร {{ $booking->room->floor->building->name }}
                        ชั้น {{ $booking->room->floor->name }}
                        ห้อง {{ $booking->room->name }}
                    </h2>
                </div>
                @if ($booking->status === BookingStatusEnum::ACTIVE)
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.booking.edit.get', ['id' => $booking->id]) }}"
                           class="btn btn-primary d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                            แก้ไข
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
            <div class="row row-cards">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header row align-items-center">
                            <div class="col-auto fs-3">
                                ข้อมูลห้อง
                            </div>
                            <div class="col-auto ms-auto badge bg-{{ BookingStatusEnum::getColor($booking->status) }}">
                                {{ BookingStatusEnum::getLabel($booking->status) }}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">ชื่อ - นามสกุล</div>
                                    <div class="datagrid-content">
                                        <div class="datagrid-content">{{ $booking->user->full_name }}</div>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">อีเมล</div>
                                    <div class="datagrid-content">{{ $booking->user->email }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">เบอร์โทรศัพท์</div>
                                    <div class="datagrid-content">{{ $booking->user->telephone }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">ค่าเช่าห้อง</div>
                                    <div class="datagrid-content">
                                        {{ number_format($booking->room->configuration->rent_fee, 2) }} บาท
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">ค่าไฟฟ้า</div>
                                    <div class="datagrid-content">
                                        <div class="datagrid-content">
                                            {{ number_format($booking->room->configuration->electric_fee, 2) }} บาท /
                                            หน่วย
                                        </div>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">ค่าน้ำประปา</div>
                                    <div class="datagrid-content">
                                        {{ number_format($booking->room->configuration->water_fee, 2) }} บาท / หน่วย
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">ค่าที่จอดรถยนต์</div>
                                    <div class="datagrid-content">
                                        <div class="datagrid-content">
                                            {{ number_format($booking->room->configuration->parking_fee*$booking->parking_amount, 2) }}
                                            บาท ({{ $booking->parking_amount }} คัน)
                                        </div>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">ค่าส่วนกลาง</div>
                                    <div class="datagrid-content">
                                        {{ number_format($booking->room->configuration->common_fee, 2) }} บาท
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">ค่ามัดจำ</div>
                                    <div class="datagrid-content">
                                        {{ number_format($booking->deposit, 2) }} บาท
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">วันที่เข้าพัก</div>
                                    <div class="datagrid-content">
                                        {{ $booking->arrival_date->format('Y-m-d') }}
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">วันที่ต้องชำระเงิน</div>
                                    <div class="datagrid-content">
                                        ทุกวันที่ {{ config('custom.due_date' ) }} ของเดือน
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">เอกสาร</h3>
                        </div>
                        <div class="list-group list-group-flush overflow-auto" style="max-height: 35rem">
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                    <span class="avatar">
                                        <svg style="color: red" xmlns="http://www.w3.org/2000/svg" width="16"
                                             height="16" fill="currentColor" class="bi bi-file-pdf"
                                             viewBox="0 0 16 16">
                                            <path
                                                d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"
                                                fill="red"></path>
                                            <path
                                                d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"
                                                fill="red"></path>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="col text-truncate">
                                        <a data-bs-toggle="modal" data-bs-target="#modal-rent"
                                           class="text-body d-block" href="">
                                            หนังสือสัญญาเช่าห้องพัก
                                        </a>
                                        <div class="text-muted text-truncate mt-n1">
                                            ขนาดไฟล์ {{ number_format($rentContractSize, 2, '.', '') }} MB
                                        </div>
                                    </div>
                                    <div class="modal" tabindex="-1" id="modal-rent">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">หนังสือสัญญาเช่าห้องพัก</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <object type="application/pdf"
                                                            data="{{ route('admin.booking.download.rent-contract', [
                                                                        'filename' => $booking->rental_contract,
                                                                  ]) }}"
                                                            width="100%" height="500" style="height: 85vh;">
                                                        ระบบของคุณไม่สนับสนุนการเปิด
                                                        <a class="btn-link"
                                                           href="{{ route('admin.booking.download.rent-contract', [
                                                                        'filename' => $booking->rental_contract,
                                                                  ]) }}">
                                                            ดาวน์โหลด
                                                        </a>
                                                    </object>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
