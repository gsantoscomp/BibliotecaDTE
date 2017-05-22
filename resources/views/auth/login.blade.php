@extends('layouts.login')

@section('title') Login - Sistema de Empréstimo de Livros @endsection

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="login-logo">
            <a style="color: white" href="{{ route('index') }}"><b>Biblioteca</b>DTE</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Entrar no Sistema</p>

            <form action="{{ route('login') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Senha">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    @if(count($errors) > 0)
                        <div class="col-xs-8">
                        @foreach($errors->all() as $error)
                            <p><span class="label label-danger" style="opacity: 0.8; font-size: 14px">{{ $error }}</span></p>
                        @endforeach
                        </div>
                    @endif
                    <div class="col-xs-4  pull-right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection

@section('scripts')
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection

@section('stylesheets')
    <style type="text/css" rel="stylesheet">
        body {
            background-color: lightslategrey !important;
        }

    </style>
@endsection    