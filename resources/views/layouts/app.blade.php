<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    @else
    <title>{{ config('app.name', 'Laravel') }}</title>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" integrity="sha384-9/D4ECZvKMVEJ9Bhr3ZnUAF+Ahlagp1cyPC7h5yDlZdXs4DQ/vRftzfd+2uFUuqS" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        <header>
            @include('./components/navbar')
            @include('./components/subnavbar')
        </header>
        <div class="container">
        @hasSection('sidebar')
            <div class="row">
                <main class="col-12 col-md-9">
                    @yield('content')
                </main>
                <aside class="col-md-3 d-none d-md-block">
                    @yield('sidebar')
                </aside>
            </div>
        @else
            <main class="">
                @yield('content')
            </main>
        @endif
        </div>
        <footer>
            
        </footer>
    </div>
</body>
</html>
