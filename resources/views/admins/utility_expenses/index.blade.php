@extends('layouts.admin')
@section('title', 'จัดการค่าน้ำค่าไฟ')
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        จัดการค่าสาธารณูปโภค
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <div class="col-auto ms-auto">
                            <a href="{{ route('admin.expenses.create', ['room' => request()->query('room')]) }}"
                               class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                     stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                เพิ่มรายการจดมิเตอร์
                            </a>
                        </div>
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
                            <form action="{{ route('admin.expenses.index') }}" method="get">
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
                                                @foreach($rooms as $room)
                                                    <option value="{{ $room->id }}"
                                                        @selected(request()->query('room') == $room->id)
                                                        @selected(old('room') == $room->id)
                                                    >
                                                        อาคาร {{ $room->floor->building->name }}
                                                        ชั้น {{ $room->floor->name }} ห้อง {{ $room->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
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
                                    <a href="{{ route('admin.invoices.index') }}" class="btn btn btn-danger"
                                       role="button">ยกเลิกการกรอง</a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ประจำเดือน</th>
                                    <th>ห้อง</th>
                                    <th>หน่วยค่าไฟที่จด</th>
                                    <th>หน่วยค่าน้ำที่จด</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($expenses as $expense)
                                    <tr>
                                        <td>
                                            <span class="text-muted">
                                            <a href="">
                                                    #{{ $expense->id }}
                                            </a>
                                            </span>
                                        </td>
                                        <td><span class="text-muted">{{ $expense->cycle_month }}</span></td>
                                        <td>
                                            <span class="text-muted">
                                                <a href="#">
                                                    อาคาร {{ $expense->room->building->name ?? '' }}
                                                    ชั้น {{ $expense->room->floor->name ?? '' }}
                                                    ห้อง {{ $expense->room->name ?? '' }}
                                                </a>
                                            </span>
                                        </td>
                                        <td><span
                                                class="text-muted">{{ $expense->electric_unit }}</span>
                                        </td>
                                        <td><span class="text-muted">{{ $expense->water_unit }}</span></td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.expenses.edit', ['expense' => $expense->id]) }}"
                                               class="btn" role="button">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-edit" width="24" height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                    <path d="M16 5l3 3"></path>
                                                </svg>
                                                แก้ไข
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
                                {{ $expenses->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
