<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <header class="site-header">
            <div class="site-header-bar">
                <div class="hd-left">
                    <button class="nav-trigger nav-trigger-main">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="site-logo">
                        <a class="site-logo-text">
                            <img src="{{ asset('/images/logo.png') }}" alt="40 by 48" />
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <main role="main">
            <div class="site-contents">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <div class="nav-overlay"></div>
        </main>
        
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
