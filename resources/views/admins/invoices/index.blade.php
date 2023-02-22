@extends('layouts.admin')
@section('title', 'จัดการรายการใบแจ้งหนี้')
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        จัดการรายการใบแจ้งหนี้
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
                            <form action="{{ route('admin.invoices.index') }}" method="get">
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
                                <div class="mb-3">
                                    <div class="form-label">สถานะใบแจ้งหนี้</div>
                                    @include('partials.admins.checkbox_status', ['enum' => \App\Enums\InvoiceStatusEnum::class])
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
                    @include('partials.admins.invoices_list_view', [
                            'invoices' => $invoices,
                            'usePagination' => true,
                            'parameters' => ['room' => request()->query('room')]
                            ])
                </div>
            </div>
        </div>
    </div>
@endsection
