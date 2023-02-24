@extends('layouts.user')
@section('title', 'รายการแจ้งซ่อม')
@section('breadcrumb', Breadcrumbs::render('user.repair'))
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        รายการแจ้งซ่อมทั้งหมด
                    </h2>
                </div>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <div class="col-auto ms-auto">
                        <a href="{{ route('user.repairs.create', ['room' => request()->query('room')]) }}"
                           class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                 width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                 stroke="currentColor" fill="none" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            เพิ่มรายการซ่อม
                        </a>
                    </div>
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
                            <form action="{{route('user.repairs.index')}}" method="get">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">ค้นหา</label>
                                            <div class="input-icon mb-3">
                                                <input type="text" name="search"
                                                       value="{{ request()->query('search') }}"
                                                       class="form-control" placeholder="รายการแจ้งช่อม">
                                                <span class="input-icon-addon">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                         height="24"
                                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                         fill="none"
                                                         stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <circle cx="10" cy="10" r="7"/>
                                                        <line x1="21" y1="21" x2="15" y2="15"/>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <div class="form-label">เลือกวันที่เข้าซ่อม</div>
                                            <input value="{{ request()->query('repair_date') }}" name="repair_date"
                                                   class="form-control"
                                                   type="date">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <div class="form-label">เลือกห้อง</div>
                                            <select name="room" class="form-select">
                                                <option value="0" selected>ทั้งหมด</option>
                                                @foreach($bookings as $booking)
                                                    <option value="{{$booking->room->id}}"
                                                        @selected(request()->query('room') == $booking->room->id)>
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
                                    <div class="form-label">สถานะแจ้งซ่อม</div>
                                    @include('partials.admins.checkbox_status', ['enum' => \App\Enums\RepairStatusEnum::class])
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
                                @if (request()->has('search') || request()->has('status'))
                                    <a href="{{ route('user.repairs.index') }}" class="btn btn btn-danger"
                                       role="button">ยกเลิกการค้นหา</a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            รายการแจ้งซ่อม
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>รายการแจ้งซ่อม</th>
                                    <th>สถานะ</th>
                                    <th>ห้องที่กำลังเช่า</th>
                                    <th>วันที่แจ้ง</th>
                                    <th>วันที่เข้าซ่อม</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($repairs as $repair)
                                    <tr>
                                        <td>
                                            <span class="text-muted">
                                            <a href="{{ route('user.repairs.index', ['repair'=> $repair->room_id]) }}">
                                                    #{{ $repair->id }}
                                            </a>
                                            </span>
                                        </td>
                                        <td><span class="text-muted">{{ $repair->subject }}</span></td>
                                        <td>
                                            <span
                                                class="badge bg-{{ \App\Enums\RepairStatusEnum::getColor($repair->status) }}">
                                                {{ \App\Enums\RepairStatusEnum::getLabel($repair->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if (isset($repair->room))
                                                <a href="{{ route('user.repairs.index', ['room'=> $repair->room_id]) }}">
                                                    อาคาร {{ $repair->room->floor->building->name ?? '' }}
                                                    ชั้น {{ $repair->room->floor->name ?? '' }}
                                                    ห้อง {{ $repair->room->name ?? '' }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ $repair->created_at }}</td>
                                        <td>{{ $repair->repair_date ?? 'ยังไม่ได้กำหนด' }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('user.repairs.show', ['repair' => $repair->id]) }}"
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
                                {{ $repairs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
