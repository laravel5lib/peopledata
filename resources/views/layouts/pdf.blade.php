<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/images/icons/cropped-500pxElEncuentro-32x32.jpg" sizes="32x32">
    <link rel="icon" href="/images/icons/cropped-500pxElEncuentro-192x192.jpg" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="/images/icons/cropped-500pxElEncuentro-180x180.jpg">
    <title>@section('title') :: {{ config('app.name', 'El Encuentro Con Dios') }} @show</title>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script defer src="{{ asset('js/fontawesome-all.js') }}"></script>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
