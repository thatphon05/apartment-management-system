<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta16
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>404 Not found - {{ config('app.name') }}</title>
    @include('partials.admins.header_assets')
</head>
<body class=" border-top-wide border-primary d-flex flex-column">
<script src="{{ asset('/dist/js/demo-theme.min.js?1668287865') }}"></script>
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="empty">
            <div class="empty-header">404</div>
            <p class="empty-title">เกิดข้อผิดพลาด</p>
            <p class="empty-subtitle text-muted">
                ไม่พบหน้าที่คุณร้องขอ
            </p>
            <div class="empty-action">
                <button onclick="history.back()" class="btn btn-primary">
                    <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <line x1="5" y1="12" x2="11" y2="18"/>
                        <line x1="5" y1="12" x2="11" y2="6"/>
                    </svg>
                    ย้อนกลับ
                </button>
            </div>
        </div>
    </div>
</div>
@include('partials.admins.body_assets')
</body>
</html>
