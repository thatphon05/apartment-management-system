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

    @include('partials.admins.header_assets')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>
<body>
<script src="{{ asset('/dist/js/demo-theme.min.js?1668287865') }}"></script>
<div class="page">

    <!-- Navbar -->
    @include('partials.admins.navbar')

    <div class="page-wrapper">

        @yield('content')

        @include('partials.admins.footer')

    </div>
</div>

@include('partials.admins.body_assets')

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

<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>


@include('partials.flash-message')

</body>
</html>
