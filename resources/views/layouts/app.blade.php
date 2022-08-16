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
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.structure.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.js')}}"></script>
    <script src="{{ asset('js/main.js')}}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/home.js') }}"></script>
</head>
<body>
<div class="admin-layout">
    <div class="global-wrapper js-open-menu-wrapper"><a class="logo js-open-menu-link" href="#"></a>
        <div class="global-nav-wrapper">
            <nav class="global-nav">
                @guest
                    <div class="global-nav-item"><a class="js-nav-link" href="{{route('login')}}" data-section="task-section">Войти</a></div>
                    <div class="global-nav-item"><a class="js-nav-link" href="{{route('register')}}" data-section="task-section">Зарегистрироваться</a></div>
                @else
                <div class="global-nav-item"><a class="js-nav-link" href="{{route('cardcheckIndex')}}">Проверка карты</a></div>
                <div class="global-nav-item"><a class="js-nav-link" href="{{route('employerIndex')}}" data-section="task-section">Анкета</a></div>
                <div class="global-nav-item"><a class="js-nav-link" href="{{route('employer2Index')}}" data-section="task-section">Анкета2</a></div>
                <div class="global-nav-item">
                    <a class="js-nav-link" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                        Выйти
                    </a>
                </div>
                 @endguest
            </nav>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <div class="global-container">
            <main class="global-content">
                <section class="global-section task-page current-section js-nav-section" data-section="task-section">
                    @yield('content')
                </section>
                <section class="global-section sectors-page js-nav-section" data-section="sectors-section">
                </section>
                <section class="global-section sections-page js-nav-section" data-section="sections-section">
                </section>
                <section class="global-section clients-page js-nav-section" data-section="clients-section">
                </section>
                <section class="global-section users-page js-nav-section" data-section="users-section">
                </section>
                <section class="global-section info-page js-nav-section" data-section="info-section">
                </section>
            </main>
        </div>
        <div class="global-framebox"></div>
    </div>
</div>
<img src="{{asset('img/loading.gif')}}" class="loading">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
