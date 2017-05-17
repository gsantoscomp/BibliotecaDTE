<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title')
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}"/>
    @yield('styles')
</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div>
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">Livros<b>DTE</b></a>
                </div>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li><a><i class="fa fa-user-circle-o"></i> Olá, {{Auth::user()->name}}</a></li>
                        <li>
                            <a href="{{route('logout')}}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Sair</a>
                            </a>
                            <form id="logout-form" action="{{route('logout')}}" method="GET">

                            </form>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>                <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <section class="content">
            @yield('myTabs')
            @yield('profileBox')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('layouts.includes.footer')
</div>
<!-- ./wrapper -->

<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

@yield('script')

</body>
</html>