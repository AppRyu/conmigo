<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('./components/navbar')
        @include('./components/subnavbar')

        <!-- トップページの場合 -->
        @if(Route::currentRouteName() === 'index')
            <main>
                @yield('content')
            </main>
        <!-- トップページ以外の場合 -->
        @else
            <div class="container">
                <div class="row">
                    <main class="col-12 col-md-9">
                        @yield('content')
                    </main>
                    <aside class="col-md-3 d-none d-md-block">
                        @yield('sidebar')
                    </aside>
                </div>
            </div>
        @endif

    </div>
</body>
</html>
