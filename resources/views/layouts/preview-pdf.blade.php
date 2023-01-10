<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    {{-- <link href="{{ asset('assets/css/app.css') }}" media="screen" type="text/css" rel="stylesheet"> --}}
    <style>
        body {
            font-family: sans-serif;
        }

        .text-left {
            text-align: left;
        }

        table {
            border-collapse: collapse;
        }
        td,
        th {
            padding: 10px;
        }

        .signature-line {
            width: 250px;
            border-bottom: 1px solid #000000
        }

        .mb-80 {
            margin-bottom: 80px
        }

        .mb-50 {
            margin-bottom: 50px
        }

        .mb-30 {
            margin-bottom: 30px
        }

        .mb-20 {
            margin-bottom: 20px
        }

        .mb-10 {
            margin-bottom: 10px
        }

        .id-label,
        .id-data {
            font-size: 35px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
    <title>@yield('title', config('app.name')) - {{ config('app.name') }}</title>
</head>

<body>
    <!--wrapper-->
    <div class="bg-white px-5 py-4">
        @yield('content')
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    @stack('js')
</body>

</html>
