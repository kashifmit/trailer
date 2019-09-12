<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Trailer App') }}</title>

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="{{ asset('js/Popper.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header class="site-header">
            <div class="site-header-bar">
                <div class="hd-left">
                    <button class="nav-trigger">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="site-logo">
                        <a class="site-logo-text" href="{{ url('/home') }}">
                            <img src="{{ asset('/images/') }}/logo.png" alt="40 by 48" />
                        </a>
                    </div>
                </div>
                <nav class="hd-right">
                    
                </nav>
            </div>
        </header>

        <main role="main">
            <div class="site-sidebar">
                <nav class="sidebar-nav">
                    <ul class="menu">
                        <li class="{{Request::path() == '/' ? 'active' : ''}}">
                            <a  href="{{ url('/') }}">
                                <i class="fas fa-user"></i>
                                <span>Login</span>
                            </a>
                        </li>
                        @guest
                            @if (Route::has('register'))
                                <li class="{{Route::currentRouteName() == 'register' ? 'active' : ''}}">
                                    <a href="{{ route('register') }}">
                                        <i class="fas fa-user-plus"></i>
                                        <span>{{ __('Create Account') }}</span>
                                    </a>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </nav>
            </div>
            <div class="site-contents">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>


        <!-- Styles -->
        <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
