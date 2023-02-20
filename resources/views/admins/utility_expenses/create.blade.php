@extends('layouts.admin')
@section('title', 'เพิ่มรายการจดมิเตอร์')
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        เพิ่มรายการจดมิเตอร์
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">

                    <div class="card mt-2">
                        <form action="{{ route('admin.expenses.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label required">มิเตอร์น้ำ</label>
                                        <input value="{{ old('water_unit') }}" name="water_unit" type="number"
                                               onchange="inputChange(event)"
                                               class="form-control  @error('water_unit') is-invalid @enderror"
                                               placeholder="มิเตอร์น้ำ">
                                        @error('water_unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label required">มิเตอร์ไฟ</label>
                                        <input value="{{ old('electric_unit') }}" name="electric_unit" type="number"
                                               onchange="inputChange(event)"
                                               class="form-control @error('electric_unit') is-invalid @enderror"
                                               placeholder="มิเตอร์ไฟ">
                                        @error('electric_unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label required">จดประจำเดือน</label>
                                        <input value="{{ old('cycle') ??
                                                (\Carbon\Carbon::today()->isSameDay(\Carbon\Carbon::today()->endOfMonth())
                                                    ? \Carbon\Carbon::today()->format('Y-m')
                                                    : \Carbon\Carbon::today()->subMonth()->format('Y-m'))
                                                }}"
                                               name="cycle" type="month"
                                               onchange="inputChange(event)"
                                               class="form-control @error('cycle') is-invalid @enderror"
                                               placeholder="จดประจำเดือน">
                                        @error('cycle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-label required">เลือกห้องพัก</div>
                                    @include('partials.admins.room_select', ['rooms' => $rooms])
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">เพิ่ม</button>
                                <a href="{{ route('admin.expenses.index', ['room' => request()->query('roomId')]) }}"
                                   class="btn btn-ghost-secondary">ย้อนกลับ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
