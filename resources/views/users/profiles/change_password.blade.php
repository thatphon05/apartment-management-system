@extends('layouts.user')
@section('title', 'เปลี่ยนรหัสผ่าน')
@section('breadcrumb', Breadcrumbs::render('user.change-password'))
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        เปลี่ยนรหัสผ่าน
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="container-xl">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-2">
                            <form action="{{ route('user.profile.change-password.post') }}"
                                  method="post"
                                  onsubmit="submitButton.disabled = true;
                                            submitButton.classList.add('btn-loading');
                                            return true;">
                                @csrf
                                <div class="card-body">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label required">รหัสผ่านเดิม</label>
                                            <input value="{{ old('password_old')}}"
                                                   name="password_old" type="password"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('password_old') is-invalid @enderror"
                                                   placeholder="รหัสผ่านเก่า">
                                            @error('password_old')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label required">รหัสผ่านใหม่</label>
                                            <input value="{{ old('password_new')}}"
                                                   name="password_new" type="password"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('password_new') is-invalid @enderror"
                                                   placeholder="รหัสผ่านใหม่">
                                            @error('password_new')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label required">ยืนยันรหัสผ่านใหม่</label>
                                            <input value="{{ old('password_new_confirmation')}}"
                                                   name="password_new_confirmation" type="password"
                                                   onchange="inputChange(event)"
                                                   class="form-control @error('password_new_confirmation') is-invalid @enderror"
                                                   placeholder="ยืนยันรหัสผ่านใหม่">
                                            @error('password_new_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" name="submitButton">เปลี่ยนรหัสผ่าน
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
