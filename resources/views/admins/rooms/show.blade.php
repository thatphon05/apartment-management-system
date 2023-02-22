@extends('layouts.admin')
@section('title', 'จัดการห้องพัก ' . $room->name )
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        รายละเอียดห้องพัก
                        อาคาร {{ $room->floor->building->name }}
                        ชั้น {{ $room->floor->name }}
                        ห้อง {{ $room->name }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        {{--                        <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"--}}
                        {{--                           class="btn btn-primary d-none d-sm-inline-block">--}}
                        {{--                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->--}}
                        {{--                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24"--}}
                        {{--                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"--}}
                        {{--                                 stroke-linecap="round" stroke-linejoin="round">--}}
                        {{--                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
                        {{--                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>--}}
                        {{--                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>--}}
                        {{--                                <path d="M16 5l3 3"></path>--}}
                        {{--                            </svg>--}}
                        {{--                            แก้ไขข้อมูล--}}
                        {{--                        </a>--}}
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
                        {{--                        <div class="card-header">--}}
                        {{--                            ผู้พักปัจจุบัน ราคาห้อง {{ $room->configuration->name }}--}}
                        {{--                        </div>--}}
                        <div class="card-header row align-items-center">
                            <div class="col-auto fs-3">
                                ข้อมูลห้อง
                            </div>
                            @if ($currentBooking)
                                <div class="col-auto ms-auto">
                                    <button data-bs-toggle="modal" data-bs-target="#modal-danger"
                                            class="btn btn-outline-pink btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
                                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M18 6l-12 12"></path>
                                            <path d="M6 6l12 12"></path>
                                        </svg>
                                        ยกเลิกการให้เช่า
                                    </button>
                                    <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form method="post"
                                                      action="{{ route('admin.booking.booking-cancel', ['id' => $currentBooking->id]) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    <div class="modal-status bg-danger"></div>
                                                    <div class="modal-body text-center py-4">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="icon mb-2 text-danger icon-lg" width="24"
                                                             height="24"
                                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M12 9v2m0 4v.01"/>
                                                            <path
                                                                d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"/>
                                                        </svg>
                                                        <h3>ยืนยันการยกเลิกการเช่าห้อง</h3>
                                                        <div class="text-muted">
                                                            คุณต้องการยกเลิก
                                                            อาคาร {{ $room->floor->building->name }}
                                                            ชั้น {{ $room->floor->name }}
                                                            ห้อง {{ $room->name }}
                                                            หรือไม่
                                                        </div>
                                                        <input type="hidden" name="user_id"
                                                               value="{{ $currentBooking->user->id }}">
                                                        <div class="mt-4">
                                                            <label class="form-check">
                                                                <input name="is_suspend_user" class="form-check-input"
                                                                       type="checkbox" checked>
                                                                <span class="form-check-label">
                                                                ต้องการระงับบัญชีของ {{ $currentBooking->user->full_name }} หรือไม่
                                                            </span>
                                                            </label>
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
                                                                    <button type="submit" class="btn btn-danger w-100"
                                                                            data-bs-dismiss="modal">
                                                                        ยืนยัน
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                @if ($currentBooking)
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">ชื่อ - นามสกุล</div>
                                        <div class="datagrid-content">
                                            <a href="{{ route('admin.users.show', ['user' => $currentBooking->user->id]) }}">
                                                {{ $currentBooking->user->full_name }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">อีเมล</div>
                                        <div class="datagrid-content">{{ $currentBooking->user->email }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">เบอร์โทรศัพท์</div>
                                        <div class="datagrid-content">{{ $currentBooking->user->telephone }}</div>
                                    </div>
                                @else
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">สถานะห้อง</div>
                                        <div class="datagrid-content">ห้องว่าง</div>
                                    </div>
                                @endif
                                <div class="datagrid-item">
                                    <div class="datagrid-title">ค่าเช่าห้อง</div>
                                    <div class="datagrid-content">
                                        {{ number_format($room->configuration->rent_fee, 2) }} บาท
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">ค่าไฟฟ้า</div>
                                    <div class="datagrid-content">
                                        <div class="datagrid-content">
                                            {{ number_format($room->configuration->electric_fee, 2) }} บาท / หน่วย
                                        </div>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">ค่าน้ำประปา</div>
                                    <div class="datagrid-content">
                                        {{ number_format($room->configuration->water_fee, 2) }} บาท / หน่วย
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">ค่าที่จอดรถ</div>
                                    <div class="datagrid-content">
                                        <div class="datagrid-content">
                                            {{ number_format($room->configuration->parking_fee, 2) }} บาท
                                        </div>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">ค่าส่วนกลาง</div>
                                    <div class="datagrid-content">
                                        {{ number_format($room->configuration->common_fee, 2) }} บาท
                                    </div>
                                </div>
                                @if ($currentBooking)
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">ค่ามัดจำ</div>
                                        <div class="datagrid-content">
                                            {{ number_format($currentBooking->deposit, 2) }} บาท
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">เอกสารของผู้พักปัจจุบัน</h3>
                        </div>
                        <div class="list-group list-group-flush overflow-auto" style="max-height: 35rem">
                            <div class="list-group-item">
                                <div class="row">
                                    @if($currentBooking)
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
                                            <a href="{{ route('admin.booking.download.rent_contract', ['filename' => $currentBooking->rental_contract]) }}"
                                               class="text-body d-block" target="_blank">
                                                หนังสือสัญญาเช่าห้องพัก
                                            </a>
                                            <div class="text-muted text-truncate mt-n1">
                                                ขนาดไฟล์ {{ number_format($rentContractSize, 2, '.', '') }} MB
                                            </div>
                                        </div>
                                    @else
                                        @include('partials.empty')
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header row align-items-center">
                            <div class="col-auto fs-3">
                                ประวัติค่าน้ำค่าไฟล่าสุด
                            </div>
                            <div class="col-auto ms-auto">
                                <a href="{{ route('admin.expenses.create', ['room' => $room->id]) }}"
                                   class="btn btn-outline-success btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor" fill="none" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 5l0 14"></path>
                                        <path d="M5 12l14 0"></path>
                                    </svg>
                                    เพิ่มรายการ
                                </a>
                            </div>
                        </div>
                        <div class="card-table table-responsive align-middle">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ประจำเดือน</th>
                                    <th>มิเตอร์น้ำ</th>
                                    <th>มิเตอร์ไฟ</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($utilityExpenses as $utilityExpense)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $utilityExpense->cycle_month }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $utilityExpense->water_unit }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $utilityExpense->electric_unit }}
                                        </td>
                                        <td class="align-middle">
                                            <a class="btn btn-info btn-sm"
                                               href="{{ route('admin.expenses.edit', ['expense' => $utilityExpense->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-eye" width="24" height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <circle cx="12" cy="12" r="2"></circle>
                                                    <path
                                                        d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                                                </svg>
                                                ดู
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

                        <div class="card-footer text-center">
                            <a href="{{ route('admin.expenses.index', ['room' => $room->id]) }}">ดูทั้งหมด</a>
                        </div>

                    </div>
                </div>
                <div class="col-md-8">
                    @include('partials.admins.invoices_list_view', ['invoices' => $invoices, 'parameters' => ['room' => $room->id]])
                </div>
                <div class="col-12">
                    @include('partials.admins.repair_list_view', ['repairs' => $repairs, 'parameters' => ['room' => $room->id]])
                </div>
                <div class="col-12">
                    <div class="card">
                        <h3 class="card-header">ประวัติการเข้าพักทั้งหมด</h3>
                        <div class="card-table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ผู้เช่า</th>
                                    <th>สถานะ</th>
                                    <th>วันที่เข้าพัก</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($bookings as $booking)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.users.show', ['user' => $booking->user->id]) }}">
                                                {{ $booking->user->full_name }}
                                            </a>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-{{ \App\Enums\BookingStatusEnum::getColor($booking->status) }}">
                                                {{ \App\Enums\BookingStatusEnum::getLabel($booking->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $booking->arrival_date }}
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
                                {{ $bookings->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
