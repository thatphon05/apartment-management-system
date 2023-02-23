<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@yield('title')</title>
    <link href="{{ asset('/dist/css/tabler.min.css?1668287865') }}" rel="stylesheet"/>

    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabunNew-Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabunlew-Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabunNew-BoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew", serif;
            font-size: 18px;
        }

        .bold {
            font-weight: bold;
        }

        td, tr {
            border: 1px solid;
        }

        html {
            margin-top: 24px;
        }
    </style>
</head>
<body>
<div class="text-end mb-4">
    <p>ข้อมูล ณ วันที่ {{ now() }}</p>
</div>
<div class="container-xl">
    <div class="card card-lg">
        @yield('content')
    </div>
</div>

</body>
</html>

