<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ $user_id ?? '' }}" >

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/station.css') }}" rel="stylesheet">
    
    <link rel="shortcut icon" href="">

</head>
<body id="fundo-externo">
    
    <div id="app">
        
        @auth

        @if(isset($station_nav))
            @if(isset($sensor_nav->type))
                <div id="navegation" title="{{ $station_nav->name.' - '.$sensor_nav->type }}" style="display:none;"></div>
            @else
                <div id="navegation" title="{{ $station_nav->name }}" style="display:none;"></div>
            @endif
        @else            
            <div id="navegation" title="{{ __('Projeto Estação') }}" style="display:none;"></div>
        @endif
        
        <div id="nav-bar"></div>

        @endguest
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
