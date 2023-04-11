<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>เข้าสู่ระบบผู้ดูแล - {{ config('app.name') }}</title>

    @include('partials.admins.header_assets')

</head>
<body class=" border-top-wide border-primary d-flex flex-column">
<script src="{{ asset('/dist/js/demo-theme.min.js?1668287865')  }}"></script>
<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
                <img src="{{ asset('/static/logo.svg') }}" height="36" alt="">
            </a>
        </div>
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">เข้าสู่ระบบผู้ดูแล</h2>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div>
                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-circle -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <circle cx="12" cy="12" r="9"/>
                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="alert-title">เกิดข้อผิดพลาด&hellip;</h4>
                                <div class="text-muted">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif

                <form action="{{ route('admin.login.post') }}"
                      onsubmit="submitButton.disabled = true;
                            submitButton.classList.add('btn-loading');
                            return true;"
                      method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">อีเมล</label>
                        <input type="email" name="email" class="form-control" placeholder="your@email.com"
                               value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">
                            รหัสผ่าน
                        </label>
                        <div class="input-group input-group-flat">
                            <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน"
                                   required>
                        </div>
                    </div>
                    <div class="form-footer">
                        <button name="submitButton" type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('partials.admins.body_assets')

</body>
</html>
