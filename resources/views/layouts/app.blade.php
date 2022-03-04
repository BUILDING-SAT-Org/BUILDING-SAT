<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=0.8, minimum-scale=0.8,
    user-scalable=no, target-densityDpi=device-dpi"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    @include('includes.head')

    <style>
        @media (min-width: 767px) and (max-width: 1920px) {
            html {
                zoom: 0.9;
            }
        }

        @media (min-width: 786px) and (max-width: 1366px) {
            html {
                zoom: 0.6;
            }
        }

        @media (min-width: 767px) and (max-width: 1280px) {
            html {
                zoom: 0.6;
            }
        }
    </style>
</head>
<body>
@yield('content')
</body>
</html>
