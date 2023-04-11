@extends('layouts.user')
@section('title', 'แจ้งซ่อม')
@section('breadcrumb', Breadcrumbs::render('user.repair-create'))
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        แจ้งซ่อม
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
                        <form action="{{ route('user.repairs.store') }}" method="post"
                              onsubmit="submitButton.disabled = true;
                                        submitButton.classList.add('btn-loading');
                                        return true;">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label required">เรื่องที่แจ้ง</label>
                                        <input value="{{ old('subject')}}"
                                               name="subject" type="text"
                                               onchange="inputChange(event)"
                                               class="form-control @error('subject') is-invalid @enderror"
                                               placeholder="เรื่องที่แจ้ง">
                                        @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <div class="form-label required">ห้อง</div>
                                        <select onchange="inputChange(event)"
                                                class="form-select @error('booking_id') is-invalid @enderror"
                                                name="booking_id">
                                            <option value="">โปรดเลือกห้อง</option>
                                            @foreach($bookings as $booking)
                                                <option value="{{$booking->id}}">
                                                    อาคาร {{ $booking->room->floor->building->name }}
                                                    ชั้น {{ $booking->room->floor->name }}
                                                    ห้อง {{ $booking->room->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('booking_id')
                                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label required">รายละเอียด</label>
                                        <textarea rows="5"
                                                  name="description" type="text"
                                                  onchange="inputChange(event)"
                                                  class="form-control @error('description') is-invalid @enderror"
                                                  placeholder="รายละเอียด">{{ old('description')}}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="submitButton">แจ้งซ่อม</button>
                                <a href="{{ route('user.repairs.index') }}"
                                   class="btn btn-ghost-secondary">ยกเลิก</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
