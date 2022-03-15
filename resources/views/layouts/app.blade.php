<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-dark">
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
    @yield('css')
    <style type="text/css">
        .page-item{
            background-color: #212529 !important;
        }

        .nav-link:hover{
            background-color: #0f0f0f !important;
        }
    </style>
</head>
<body style="background-image: url('../img/bg4.jpg');">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item border-bottom" href="{{ route('home') }}">
                                        Painel
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <main>
                        @yield('content')
                    </main>
                </div>
                <div class="col-md-3 pt-5 pb-5">
                    <ul class="nav flex-column" style="background-color: #000; border: solid 1px #f0f0f0;">
                        <li class="nav-item">
                            <form class="d-flex align-items-center flex-nowrap" action="{{route('search')}}" method="GET">
                                <input style="border-radius: 0px;" class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Search" name="search">
                                <button class="btn btn-success my-2 my-sm-0" type="submit" style="border-radius: 0px;"><i class="fas fa-search"></i></button>
                            </form>
                        </li>
                        <li class="nav-item border-bottom">
                            <a style="text-decoration: none; color: #fff" class="nav-link" href="{{route('postCategory', 1)}}">Cidades mais faladas <i class="fas fa-angle-right"></i></a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a style="text-decoration: none; color: #fff" class="nav-link" href="{{route('postCategory', 2)}}">Estados mais falados <i class="fas fa-angle-right"></i></a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a style="text-decoration: none; color: #fff" class="nav-link" href="{{route('postCategory', 3)}}">Melhores cidades <i class="fas fa-angle-right"></i></a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a style="text-decoration: none; color: #fff" class="nav-link" href="{{route('postCategory', 4)}}">Melhores estados <i class="fas fa-angle-right"></i></a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a style="text-decoration: none; color: #fff" class="nav-link" href="{{route('postCategory', 5)}}">Destinos mais desejados <i class="fas fa-angle-right"></i></a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a style="text-decoration: none; color: #fff" class="nav-link" href="{{route('postCategory', 6)}}">Destinos mais visitados <i class="fas fa-angle-right"></i></a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a style="text-decoration: none; color: #fff" class="nav-link" href="{{route('postCategory', 7)}}">Piores destinos <i class="fas fa-angle-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
            @yield('js')
    </div>
</body>
</html>
