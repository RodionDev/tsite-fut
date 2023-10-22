<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta nama="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('site-title') - {{ env('APP_NAME', 'FCH') }}</title>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    @hasSection('css')
        <link rel="stylesheet" href="
        {{ URL::to('/') . "/css/" }}@yield('css'){{ ".css" }}
        ">
    @endif
</head>
<body>
    <header>
        @section('header')
            @include('components/header/header')
        @show
    </header>
    <div class="content container flow-text">
        @yield('content')
    </div>
    <footer class="container">
        @section('footer')
            @include('components/sponsors')
        @show
        <script src="{{ URL::asset('./js/app.js') }}"></script>
        @hasSection('js')
            <script src="
            {{ URL::to('/') . "/js/" }}@yield('js'){{ ".js" }}
            "></script>
        @endif
    </footer>
</body>
</html>
