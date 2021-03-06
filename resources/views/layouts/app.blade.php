<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @if(config('app.env') === 'production')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-96N93L7KWP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-96N93L7KWP');
    </script>
    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="プログラミング・WEBデザイン学習者を対象としたオンライン学習コミュニティマッチングサービス。1人だと学習が継続できない集中できないなどのお悩みを抱えた方はここで一緒に学習するお友達を見つけよう。">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@appryu_0722">
    <meta property="og:url" content="https://appryu.net">
    <meta property="og:title" content="Conmigo もくもく会マッチングサービス">
    <meta property="og:description" content="プログラミング・WEBデザイン学習者を対象としたオンライン学習コミュニティマッチングサービス。1人だと学習が継続できない集中できないなどのお悩みを抱えた方はここで一緒に学習するお友達を見つけよう。">
    <meta property="og:image" content="{{ asset('./img/org_image.png') }}">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
    <title>{{ config('app.name', 'Conmigo') }}/@yield('title')</title>
    @else
    <title>{{ config('app.name', 'Conmigo') }}</title>
    @endif

    <!-- favicon -->
    <link rel="icon" type="image/png" href="{{ asset('./img/favicon_c.svg') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" integrity="sha384-9/D4ECZvKMVEJ9Bhr3ZnUAF+Ahlagp1cyPC7h5yDlZdXs4DQ/vRftzfd+2uFUuqS" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        <header>
            @include('./components/navbar')
            @include('./components/subnavbar')
        </header>
        <main class="main container u-py-lg u-md-py-xxl">
        @hasSection('sidebar')
            <div class="row">
                <article class="col-lg-9 col-md-8 col-12">
                    @yield('content')
                </article>
                <aside class="col-lg-3 col-md-4 d-none d-md-block">
                    @yield('sidebar')
                </aside>
            </div>
        @else
            <article>
                @yield('content')
            </article>
        @endif
        </main>
        @include('./components/footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
