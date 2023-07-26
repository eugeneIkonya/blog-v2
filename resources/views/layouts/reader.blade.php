<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    <meta name='ir-site-verification-token' value='113904460'>
    {{-- mobile specific metas --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- script --}}
    <script src="{{ asset('js/modernizr.js') }}"></script>
    {{-- favicons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest')}}">
</head>
    @include('components.google')
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
