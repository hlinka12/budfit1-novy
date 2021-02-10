<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/css/style.css">
        <title>BUDFIT</title>
    </head>

    <body>
        <nav>
            <div class="meno">
                <h3>BUDFIT</h3>
            </div>
            <ul class="nav-links">
                <li><a href="/">Domov</a></li>
                <li><a href="/about">O nás</a></li>
                <li><a href="/articles">Články</a></li>
                @guest
                        @if (Route::has('login'))
                            <li>
                                <a href="{{ route('login') }}">Prihlásiť sa</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li>
                                    <a href="{{ route('register') }}">Registrácia</a>
                            </li>
                        @endif
                @else
                    <li>
                        <a href="/home">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Odhlásiť') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                    </li>
                @endguest

            </ul>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </nav>
        <script src="/css/slide.js"></script>
        <div class="container">
            @include('messages.message')
            @yield('content')
        </div>
    </body>

</html>