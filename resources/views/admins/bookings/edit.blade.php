@extends('layouts.admin')
@section('title', 'รายละเอียดการเช่า')
@section('breadcrumb', Breadcrumbs::render('admin.booking-edit', $booking))
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        รายละเอียดการเช่า
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
                        <form action="{{ route('admin.booking.edit.post', ['id' => $booking->id]) }}"
                              onsubmit="submitButton.disabled = true;
                                  submitButton.classList.add('btn-loading');
                                  return true;"
                              method="post">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label required">จำนวนที่จอดรถยนต์</label>
                                        <input value="{{ old('parking_amount') ?? $booking->parking_amount }}"
                                               name="parking_amount" onchange="inputChange(event)"
                                               class="form-control @error('parking_amount') is-invalid @enderror"
                                               placeholder="จำนวนที่จอดรถยนต์">
                                        @error('parking_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label required">วันที่จะเข้าพัก</label>
                                        <input
                                            value="{{ old('arrival_date') ?? $booking->arrival_date->format('Y-m-d') }}"
                                            name="arrival_date"
                                            type="date"
                                            onchange="inputChange(event)"
                                            class="form-control @error('arrival_date') is-invalid @enderror"
                                            placeholder="วันที่จะเข้าพัก">
                                        @error('arrival_date')
                                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="submitButton">แก้ไข</button>
                                <a href="{{ route('admin.booking.show', ['id' => $booking->id]) }}"
                                   class="btn btn-ghost-secondary">ย้อนกลับ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
