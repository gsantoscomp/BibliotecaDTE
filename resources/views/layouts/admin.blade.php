<!doctype html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('stylesheets')
</head>
<body class="hold-transition skin-blue sidebar-mini">
@yield('content')
@include('layouts.includes.header')
@include('layouts.includes.left')
@include('layouts.includes.footer')
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>

