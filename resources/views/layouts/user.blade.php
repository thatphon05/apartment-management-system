<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('title') - {{ config('app.name') }}</title>

    @include('partials.users.header_assets')

</head>
<body>
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

    window.onunload = function () {
        const element = document.getElementsByClassName('btn-loading');
        element.classList.remove('btn-loading');
    };

    function inputChange(event) {
        event.currentTarget.classList.remove("is-invalid");
    }

    function loadingButton(element) {
        element.disabled = true;
        element.classList.add('btn-loading');
    }

</script>

@include('partials.flash-message')

</body>
</html>
