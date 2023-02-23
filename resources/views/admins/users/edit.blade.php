@extends('layouts.admin')
@section('title', 'แก้ไขผู้เช่า ' . $user->full_name)
@section('breadcrumb', Breadcrumbs::render('admin.user-edit', $user))
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        แก้ไขผู้เช่า - {{ $user->full_name }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <div class="d-flex">
                                    <div>
                                        <!-- Download SVG icon from http://tabler-icons.io/i/alert-circle -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon"
                                             width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <circle cx="12" cy="12" r="9"/>
                                            <line x1="12" y1="8" x2="12" y2="12"/>
                                            <line x1="12" y1="16" x2="12.01" y2="16"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="alert-title">เกิดข้อผิดพลาด&hellip;</h4>
                                    </div>
                                </div>
                                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                            </div>
                        @endif

                        <div class="row gx-4">
                            <div class="col-md-6">
                                <h3 class="card-header fw-bold">ข้อมูลส่วนตัว</h3>
                                <div class="row card-body">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label required">อีเมล</label>
                                            <input value="{{ old('email') ?? $user->email }}" name="email" type="email"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="อีเมล" disabled>
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">รหัสผ่าน</label>
                                            <input value="{{ old('password') }}" name="password" type="password"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   placeholder="รหัสผ่าน">
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label required">เบอร์โทรศัพท์</label>
                                            <input value="{{ old('telephone') ?? $user->telephone }}" type="text"
                                                   name="telephone"
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
                                            <input value="{{ old('id_card') ?? $user->id_card_number }}" maxlength="13"
                                                   name="id_card"
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
                                            <input value="{{ old('birthdate') ?? $user->birthdate->format('Y-m-d') }}"
                                                   name="birthdate"
                                                   type="date"
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
                                            <input value="{{ old('religion') ?? $user->religion }}" name="religion"
                                                   type="text"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('religion') is-invalid @enderror"
                                                   placeholder=ศาสนา>
                                            @error('religion')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label required">ชื่อ</label>
                                            <input value="{{ old('name') ?? $user->name }}" name="name" type="text"
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
                                            <input value="{{ old('surname') ?? $user->surname }}" name="surname"
                                                   type="text"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('surname') is-invalid @enderror"
                                                   placeholder="นามสกุล">
                                            @error('surname')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label required">ที่อยู่</label>
                                            <textarea name="address" type="text"
                                                      onchange="inputChange(event)"
                                                      class="form-control @error('address') is-invalid @enderror"
                                                      placeholder="ที่อยู่">{{ old('address') ?? $user->address }}</textarea>
                                            @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label required">ตำบล</label>
                                            <input value="{{ old('sub_district') ?? $user->subdistrict }}"
                                                   name="sub_district" type="text"
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
                                            <input value="{{ old('district') ?? $user->district }}" name="district"
                                                   type="text"
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
                                                        value="{{ $province }}"
                                                        @selected($user->province == $province)
                                                        @selected(old('province') == $province)
                                                    >
                                                        {{ $province }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('province')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label required">รหัสไปรษณีย์</label>
                                            <input value="{{ old('postal_code') ?? $user->postal_code }}"
                                                   name="postal_code" type="text"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('postal_code') is-invalid @enderror"
                                                   placeholder="รหัสไปรษณีย์" maxlength="5">
                                            @error('postal_code')
                                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="card-header fw-bold">อัพโหลดเอกสาร</h3>
                                <div class="row card-body">
                                    <label class="form-label text-danger required">หากแนบไฟล์ใหม่จะเป็นการแก้ไข</label>
                                    <div class="mb-3 mt-3">
                                        <label for="formFile" class="form-label">สำเนาบัตรประชาชน
                                            (.pdf)</label>
                                        <input name="id_card_copy"
                                               onchange="inputChange(event)"
                                               class="form-control @error('id_card_copy') is-invalid @enderror"
                                               type="file" accept="application/pdf">
                                        @error('id_card_copy')
                                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">สำเนาทะเบียนบ้าน
                                            (.pdf)</label>
                                        <input
                                            name="copy_house_registration"
                                            onchange="inputChange(event)"
                                            class="form-control @error('copy_house_registration') is-invalid @enderror"
                                            type="file" accept="application/pdf">
                                        @error('copy_house_registration')
                                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <h3 class="card-header fw-bold">ปรับสถานะบัญชี</h3>
                                <div class="row card-body">
                                    <div class="mb-3">
                                        @foreach(\App\Enums\UserStatusEnum::values() as $key => $value)
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="status" value="{{ $key }}"
                                                    @checked(\App\Enums\UserStatusEnum::from($key) === $user->status)
                                                >
                                                <span
                                                    class="form-check-label">
                                                    {{ \App\Enums\UserStatusEnum::getLabel($value) }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                        <a href="{{ route('admin.users.index') }}"
                           class="btn btn-ghost-secondary">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
