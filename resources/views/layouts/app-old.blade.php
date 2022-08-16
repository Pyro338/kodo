<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('personalIndex')}}">Личный кабинет</a>
                                    <a class="dropdown-item" href="{{route('transliterateIndex')}}">Транслитерация имени</a>
                                    <a class="dropdown-item" href="{{route('cardcheckIndex')}}">Проверка карты</a>
                                    <a class="dropdown-item" href="{{route('docusignIndex')}}">Подпись документа</a>
                                    <a class="dropdown-item" href="{{route('underwritingIndex')}}">Андеррайтинг</a>
                                    <a class="dropdown-item" href="{{route('terroristscheckIndex')}}">Проверка на террориста</a>
                                    <a class="dropdown-item" href="{{route('fsspIndex')}}">Проверка в ФССП</a>
                                    <a class="dropdown-item" href="{{route('employerIndex')}}">Работодатель</a>
                                    <hr>
                                    <a class="dropdown-item" href="{{route('lettersIndex')}}">Правила транслитерации</a>
                                    <a class="dropdown-item" href="{{route('binsIndex')}}">Список Bin'ов</a>
                                    <a class="dropdown-item" href="{{route('terroristsIndex')}}">Список террористов</a>
                                    <a class="dropdown-item" href="{{route('finCodesIndex')}}">Бухгалтерские коды</a>
                                    <a class="dropdown-item" href="{{route('regionCodesIndex')}}">Коды регионов</a>
                                    <a class="dropdown-item" href="{{route('okopfIndex')}}">Коды ОКОПФ</a>
                                    <hr>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<img src="{{asset('img/loading.gif')}}" class="loading">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
