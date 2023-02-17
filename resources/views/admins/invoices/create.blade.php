@extends('layouts.admin')
@section('title', 'สร้างใบแจ้งหนี้')
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        สร้างใบแจ้งหนี้
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
                        <form action="{{ route('admin.invoices.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label required">ใบแจ้งหนี้ประจำเดือน</label>
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
                                <button type="submit" class="btn btn-primary">สร้าง</button>
                                <a href="{{ route('admin.invoices.index') }}"
                                   class="btn btn-ghost-secondary">ย้อนกลับ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
