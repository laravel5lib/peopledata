<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="http://www.elencuentrocondios.com/wp-content/uploads/2016/08/cropped-500pxElEncuentro-32x32.jpg" sizes="32x32">
    <link rel="icon" href="http://www.elencuentrocondios.com/wp-content/uploads/2016/08/cropped-500pxElEncuentro-192x192.jpg" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="http://www.elencuentrocondios.com/wp-content/uploads/2016/08/cropped-500pxElEncuentro-180x180.jpg">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title') :: {{ config('app.name', 'El Encuentro Con Dios') }} @show</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
    <script defer src="{{ asset('js/fontawesome-all.js') }}"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/logos/el-encuentro-168x100.png') }}" height="30" alt="El Encuentro con Dios" class="d-inline-block align-top">
                    Actualización de Datos :: El Encuentro con Dios
                </a>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
