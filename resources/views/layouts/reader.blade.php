<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">

    {{-- mobile specific metas --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    {{-- script --}}
    <script src="{{ asset('js/modernizr.js') }}"></script>
    {{-- favicons --}}
    {{-- <link rel="manifest" href="site.webmanifest"> --}}

</head>

<body>
    {{-- preloader --}}
    <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div id="top" class="s-wrap site-wrapper">
        {{-- site header --}}
        @include('components.header')
        @include('components.search')
        <div class="s-content">
            @yield('content')
        </div>
        
        @include('components.footer')
    </div>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
