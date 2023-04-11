@extends('layouts.admin')
@section('title', 'เพิ่มผู้เช่า')
@section('breadcrumb', Breadcrumbs::render('admin.user-create'))
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        เพิ่มผู้เช่า
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.users.store') }}" method="post"
                  enctype="multipart/form-data" onsubmit="submitButton.disabled = true;
                  submitButton.classList.add('btn-loading');
                  return true;">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row gx-4">
                            <div class="col-md-6">
                                <h3 class="card-header fw-bold">บัญชีสำหรับเข้าสู่ระบบ</h3>
                                <div class="row card-body">
                                    <div class="col-md-12">
                                        <div class="mb-3 mt-1">
                                            <label class="form-label required">อีเมล</label>
                                            <input value="{{ old('email') }}" name="email" type="email"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="อีเมล" autocomplete="off">
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label required">รหัสผ่าน</label>
                                            <input value="{{ old('password') }}" name="password" type="password"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   placeholder="รหัสผ่าน" autocomplete="off">
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <h3 class="card-header fw-bold">ข้อมูลส่วนตัว</h3>
                                <div class="row card-body">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label required">ชื่อ</label>
                                            <input value="{{ old('name') }}" name="name" type="text"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   placeholder="ชื่อ">
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label required">นามสกุล</label>
                                            <input value="{{ old('surname') }}" name="surname" type="text"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('surname') is-invalid @enderror"
                                                   placeholder="นามสกุล">
                                            @error('surname')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label required">เบอร์โทรศัพท์</label>
                                            <input value="{{ old('telephone') }}" type="text" name="telephone"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('telephone') is-invalid @enderror"
                                                   placeholder="เบอร์โทรศัพท์" maxlength="10">
                                            @error('telephone')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-5">
                                        <div class="mb-3">
                                            <label class="form-label required">หมายเลขบัตรประชาชน</label>
                                            <input value="{{ old('id_card') }}" maxlength="13" name="id_card"
                                                   type="text"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('id_card') is-invalid @enderror"
                                                   placeholder="หมายเลขบัตรประชาชน">
                                            @error('id_card')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label required">วันเกิด</label>
                                            <input value="{{ old('birthdate') }}" name="birthdate" type="date"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('birthdate') is-invalid @enderror"
                                                   placeholder="เลือกวันเกิด">
                                            @error('birthdate')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label required">ศาสนา</label>
                                            <input value="{{ old('religion') }}" name="religion" type="text"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('religion') is-invalid @enderror"
                                                   placeholder=ศาสนา>
                                            @error('religion')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label required">ที่อยู่</label>
                                            <textarea name="address" type="text"
                                                      onchange="inputChange(event)"
                                                      class="form-control @error('address') is-invalid @enderror"
                                                      placeholder="ที่อยู่">{{ old('address') }}</textarea>
                                            @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label required">ตำบล</label>
                                            <input value="{{ old('sub_district') }}" name="sub_district" type="text"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('sub_district') is-invalid @enderror"
                                                   placeholder="ตำบล">
                                            @error('sub_district')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label required">อำเภอ</label>
                                            <input value="{{ old('district') }}" name="district" type="text"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('district') is-invalid @enderror"
                                                   placeholder="อำเภอ">
                                            @error('district')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label required">จังหวัด</label>
                                            <select name="province" class="form-select">
                                                @foreach(getAllProvince() as $province)
                                                    <option
                                                        value="{{ $province }}" @selected(old('province') == $province)>
                                                        {{ $province }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('province')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label required">รหัสไปรษณีย์</label>
                                            <input value="{{ old('postal_code') }}" name="postal_code" type="text"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('postal_code') is-invalid @enderror"
                                                   placeholder="รหัสไปรษณีย์" maxlength="5">
                                            @error('postal_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h3 class="card-header row-cards fw-bold">อัพโหลดเอกสาร</h3>
                                <div class="row card-body">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label required">สำเนาบัตรประชาชน
                                            (.pdf)</label>
                                        <input value="{{ old('id_card_copy') || 1 }}" name="id_card_copy"
                                               onchange="inputChange(event)"
                                               class="form-control @error('id_card_copy') is-invalid @enderror"
                                               type="file" accept="application/pdf">
                                        @error('id_card_copy')
                                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label required">สำเนาทะเบียนบ้าน
                                            (.pdf)</label>
                                        <input value="{{ old('copy_house_registration') }}"
                                               name="copy_house_registration"
                                               onchange="inputChange(event)"
                                               class="form-control @error('copy_house_registration') is-invalid @enderror"
                                               type="file" accept="application/pdf">
                                        @error('copy_house_registration')
                                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="mb-3">
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
                                <h3 class="card-header fw-bold">รายละเอียดการเช่า</h3>
                                <div class="row card-body">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-label required">เลือกห้องพัก</div>
                                            @include('partials.admins.room_select', ['rooms' => $rooms])
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">วันที่จะเข้าพัก</label>
                                            <input value="{{ old('arrival_date') }}" name="arrival_date"
                                                   type="date"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('arrival_date') is-invalid @enderror"
                                                   placeholder="วันที่จะเข้าพัก">
                                            @error('arrival_date')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">จำนวนที่จอดรถยนต์</label>
                                            <input value="{{ old('parking_amount') ?? 0 }}" name="parking_amount"
                                                   type="text"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('parking_amount') is-invalid @enderror"
                                                   placeholder="จำนวนที่จอดรถ">
                                            @error('parking_amount')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">ค่ามัดจำ</label>
                                            <input value="{{ old('deposit') ?? $config->deposit }}" name="deposit"
                                                   type="number"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('parking_amount') is-invalid @enderror"
                                                   placeholder="ค่ามัดจำ">
                                            @error('deposit')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary" name="submitButton">บันทึกข้อมูล</button>
                        <a href="{{ route('admin.users.index') }}"
                           class="btn btn-ghost-secondary">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
