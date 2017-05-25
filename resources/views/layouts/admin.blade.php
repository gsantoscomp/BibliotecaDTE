<!doctype html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Hind+Siliguri" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('stylesheets')
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

@include('layouts.includes.header')
@include('layouts.includes.left')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="col-md-6">
            <section style="margin-bottom:10px" class="content-header">
                <h1>
                    @yield('title')
                    <small>@yield('subtitle')</small>
                </h1>
            </section>
        </div>
    @yield('notificationTitle')



    <!-- Main content -->
        <section class="content">

            {{-- Modal --}}
            <div class="modal fade" id="modal-add" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">
                                Cadastrar @yield('title')
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form id="modal-form" autocomplete="off">
                                @yield('modalForm')
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button id="btn-confirm" type="submit" class="btn btn-primary">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Table -->
                @yield('cols')
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="table" class="table no-margin">
                                <thead>
                                <tr>
                                    @yield('thTable')
                                </tr>
                                </thead>
                                <tbody  class="table-body">
                                @yield('tableBody')
                                </tbody>
                            </table>

                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        @yield('button')
                        <a class="btn btn-sm btn-default btn-flat" id="open-options"><i
                                    class="fa fa-cogs"></i></a>
                        <a class="btn btn-sm btn-default btn-flat options hidden" id="btn-delete"><i
                                    class="fa fa-trash"></i> Apagar </a>
                        @yield('pagination')
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
        @yield('requests')
        @yield('notifications')
    </div>
    </section>
</div>
@include('layouts.includes.footer')
</div>

<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript">
    var token = $("meta[name=csrf-token]").attr("content");
    function clearModal() {
        $(this).find("input,textarea,select").val('').end();
    }
    function dateFormat(date) {
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        day = day.toString();
        if (day.length == 1) {
            day = '0' + day;
        }
        month = month.toString();
        if (month.length == 1) {
            month = '0' + month;
        }
        var fullDate = day + '/' + month + '/' + year;
        return fullDate;
    }
    function onClickAdd() {
        $(".options").addClass("hidden");
        $("#modal-add").modal("toggle");
    }

    function onClickOpenOptions() {
        $(".options").toggleClass("hidden");
    }
    function onClickCheck() {
        $('.icheck').iCheck('check');
        $('#check-all').on('ifUnchecked', function () {
            $('.icheck').iCheck('uncheck');
        });
    }

    function onClickBtnDelete() {
        $(".items:checked").each(function () {

            var row = $(this).closest('tr');
            var id = $(this).val();
            var url = @yield('url');
            $.ajax({
                url: url + id,
                method: "POST",
                data: {
                    _token: token,
                    _method: "DELETE"
                },
                success: function (response) {
                    row.remove();
                    var empty = isEmpty($('#table').children('tbody').children().length);
                    console.log($('#table').children('tbody').children());
                    if (empty) {
                        $('#table').empty();
                        $('#table').append('<p id="p">Não foram encontrados resultados.</p>');
                        $("#open-options").addClass('hidden');
                        $("#btn-delete").addClass('hidden');
                    }
                    console.log(response);
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });
    }
    //Check items
    function isEmpty(tableLength) {
        if (tableLength == 0) {
            return true;
        }
        else {
            return false;
        }
    }
    $(document).ready(function () {
//        console.log($("tbody").children());
        if (isEmpty($(".table-body").children().length)) {
            $("#open-options").addClass('hidden');
        }
        $("#add").on("click", onClickAdd);
        $("#open-options").on('click', onClickOpenOptions);
        $("#btn-delete").on("click", onClickBtnDelete);
        $("#modal-add").on('hidden.bs.modal', clearModal);
        $('#check-all').on('ifChecked', onClickCheck);
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>

@yield('scripts')
</body>
</html>

