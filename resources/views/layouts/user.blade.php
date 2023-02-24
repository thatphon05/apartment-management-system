@php
    \Carbon\Carbon::setlocale(config('app.locale'));
@endphp
    <!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta16
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('title') - {{ config('app.name') }}</title>

    @include('partials.users.header_assets')

</head>
<body>
<script src="{{ asset('/dist/js/demo-theme.min.js?1668287865') }}"></script>
<div class="page">

    <!-- Navbar -->
    @include('partials.users.navbar')

    <div class="page-wrapper">

        <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        @yield('breadcrumb')
                    </div>
                </div>
            </div>
        </div>

        @yield('content')

        @include('partials.users.footer')

    </div>
</div>

@include('partials.users.body_assets')

@yield('script')

<script>
    //$("input").removeClass("is-invalid");
    function inputChange(event) {
        event.currentTarget.classList.remove("is-invalid");
    }

    @if (config('app.debug') === true)
    console.info('Query time:', {{ $countQuery }})
    @endif

</script>

</body>
</html>
