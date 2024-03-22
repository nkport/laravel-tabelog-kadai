<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png" />

    <!-- Style CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Noto+Sans+JP:wght@100..900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/21cb561351.js" crossorigin="anonymous"></script>

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/vegas/2.4.4/vegas.min.css">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/common.js') }}" defer></script>

    <!-- Laravel Breeze -->
    @vite(['resources/js/app.js'])
</head>


<body>

    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <div class="wrapper">
        <div class="container">
            <div class="kadomaru-box">
                {{ $slot }}
            </div>
        </div>
    </div>

    <p id="page-top"><a href="#"><span><i class="fa-solid fa-chevron-up"></i><br>PAGE TOP</span></a></p>

    @component('components.footer')
    @endcomponent

    @stack('scripts')

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Slick -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vegas/2.4.4/vegas.min.js"></script>

    {{-- 後で消す --}}
    <script src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-4/js/6-1-4.js"></script>

    <script src="{{ asset('js/slick.js') }}"></script>

</body>

</html>
