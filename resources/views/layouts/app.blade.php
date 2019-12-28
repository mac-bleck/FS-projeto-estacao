<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/station.css') }}" rel="stylesheet">
    
    <link rel="shortcut icon" href="">

</head>
<body id="fundo-externo">
    
    <div id="app">
        
        @auth
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm backgound">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="color: #555;">
                    {{ __('Home') }}
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @isset($station_nav)
                            <a class="navbar-brand" href="{{ route('main', ['station' => $station_nav->id]) }}">
                                <div style="color: #555;">
                                    <i class="fas fa-chevron-right"></i>
                                    {{$station_nav->name}}
                                </div>
                            </a>

                            @isset($sensor_nav->type)
                                <a class="navbar-brand" href="{{route('sensor.show', ['id' => $sensor_nav->id]) }}">
                                    <div style="color: #555;">
                                        <i class="fas fa-chevron-right"></i>
                                        {{$sensor_nav->type}}
                                    </div>
                                </a>
                            @endisset

                        @endisset
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link icon-menu-nav" href="{{ route('stations.index') }}">
                                    <!-- {{ __('Estações') }} -->
                                    <i class="fas fa-th-large fa-2x"></i>
                                </a>
                            </li>
                            <!-- Authentication Links -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link icon-menu-nav" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> 
                                    <!-- {{ __('Usuario') }} -->
                                    <i class="fas fa-user-circle fa-2x"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <i class="dropdown-item">{{ Auth::user()->name }}</i>    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>
        @endguest
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
