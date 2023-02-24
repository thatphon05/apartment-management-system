@extends('layouts.admin')
@section('title', 'เพิ่มข้อมูลการเช่า')
@section('breadcrumb', Breadcrumbs::render('admin.booking-create', $user))
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        เพิ่มข้อมูลการเช่า
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
                        <form action="{{ route('admin.booking.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input name="user_id" type="hidden" value="{{ $user->id }}">
                            <div class="card-body">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label required">ผู้เช่า</label>
                                        <input value="{{ $user->full_name }}"
                                               class="form-control"
                                               disabled
                                               placeholder="{{ $user->full_name }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 mt-3">
                                        <label for="formFile" class="form-label required">หนังสือสัญญาเช่าห้องพัก
                                            (.pdf)</label>
                                        <input value="{{ old('rent_contract"') }}" name="rent_contract"
                                               onchange="inputChange(event)"
                                               class="form-control @error('rent_contract') is-invalid @enderror"
                                               type="file" id="formFile" accept="application/pdf">
                                        @error('rent_contract')
                                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label required">วันที่จะเข้าพัก</label>
                                        <input value="{{ old('arrival_date') }}" name="arrival_date"
                                               type="date"
                                               onchange="inputChange(event)"
                                               class="form-control @error('arrival_date') is-invalid @enderror"
                                               placeholder="วันที่จะเข้าพัก">
                                        @error('arrival_date')
                                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label required">จำนวนที่จอดรถ</label>
                                        <input value="{{ old('parking_amount') ?? 0 }}"
                                               name="parking_amount"
                                               type="text"
                                               onchange="inputChange(event)"
                                               class="form-control @error('parking_amount') is-invalid @enderror"
                                               placeholder="จำนวนที่จอดรถ">
                                        @error('parking_amount')
                                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label required">ค่ามัดจำ</label>
                                        <input value="{{ old('deposit') ?? $config->deposit }}"
                                               name="deposit"
                                               type="number"
                                               onchange="inputChange(event)"
                                               class="form-control @error('parking_amount') is-invalid @enderror"
                                               placeholder="ค่ามัดจำ">
                                        @error('deposit')
                                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-label required">เลือกห้องพัก</div>
                                    @include('partials.admins.room_select', ['rooms' => $rooms])
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">เพิ่มข้อมูลการเช่า</button>
                                <a href="{{ route('admin.users.show', ['user' => request()->query('user')]) }}"
                                   class="btn btn-ghost-secondary">ย้อนกลับ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
