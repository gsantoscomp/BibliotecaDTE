@extends('layouts.admin')

@section('title')
    Empréstimos
@endsection

@section('subtitle')
    Gerenciar
@endsection

@section('tableTitle')
    Empréstimo
@endsection

@section('thTable')
    @if(count($loans) > 0)
        <th class="options hidden icheck">
            <input id="check-all" type="checkbox">
        </th>
        <th>Usuário</th>
        <th>Livro</th>
        <th>Data de empréstimo</th>
        <th>Data de devolução</th>
        <th style="text-align:center">Situação</th>
    @else
        <p id="p">Não foram encontrados resultados</p>
    @endif
@endsection

@section('tableBody')
    @foreach ($loans as $loan)
        <tr>
            <td class="options hidden icheck">
                <input class="items" type="checkbox" value="{{ $loan->ln_id }}">
                <input type="hidden" name="ln_bk_id" value="{{ $loan->ln_bk_id }}">
            </td>
            <td>{{ $loan->name }}</td>
            <td>{{ $loan->bk_title }}</td>
            <td>{{ date('d/m/Y', strtotime($loan->ln_date)) }}</td>
            <td>{{ date('d/m/Y', strtotime($loan->ln_due_date)) }}</td>
            <td style="text-align:center">
                @if($loan->ln_status == 0)
                    <i class="fa fa-smile-o" style="color:green; font-size:22px"></i>
                @elseif ($loan->ln_status == 1)
                    <i class="fa fa-meh-o" style="color:orange; font-size:22px"></i>
                @elseif ($loan->ln_status == 2)
                    <i class="fa fa-frown-o" style="color:red; font-size:22px"></i>
                @endif
            </td>
        </tr>
    @endforeach

@endsection

@section('url')
    '/loan/'
@endsection

@section('notificationTitle')
    <div class="col-md-6">
        <section style="margin-bottom: 10px" class="content-header">
            <h1>
                Notificações
                <small>Gerenciar</small>
            </h1>
        </section>
    </div>

@endsection

@section('cols')
    <div class="col-md-6">
        @endsection

        @section('notifications')
            <div class="col-md-6">
                <div class="box box-success">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="request-table" class="table no-margin">
                                <thead>
                                <tr>
                                    @if(count($notifications) > 0)
                                        <th>Usuário</th>
                                        <th>Livro</th>
                                        <th>Opções</th>
                                    @else
                                        <p id="p">Nenhuma notificação pendente</p>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                {{ csrf_field() }}
                                @foreach($notifications as $notification)
                                    <tr>
                                        <input type="hidden" value="{{ $notification->id }}">
                                        <td class="user-value">{{ $notification->user }}</td>
                                        <td class="book-value">{{ $notification->book }}</td>
                                        <td>
                                            <a class="btn btn-success accept-request"
                                               style="margin-right:5px">Aceitar</a>
                                            <a class="btn btn-danger decline-request"
                                               style="margin-left:5px">Recusar</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        @endsection

        @section('scripts')
            <script type="text/javascript">
                $(document).ready(function () {
                    var token = $("meta[name=csrf-token]").attr("content");
                    //Add loan
                    $("#btn-confirm").on("click", function (e) {
                        e.preventDefault();

                        var user = $("#loan-form-user").val();
                        var book = $("#loan-form-book").val();
                        var userName = $('#loanUserOption' + user).text();
                        var bookName = $('#loanBookOption' + book).text();
                        $.ajax({
                            url: "/loan",
                            method: "POST",
                            data: {
                                _token: token,
                                user: user,
                                book: book
                            },
                            success: function (data) {
                                $("#modal-add").modal("toggle");
                                $('#loanBookOption' + book).addClass('hidden');
                                data = data[0];
                                var date = new Date();
                                var dueDate = new Date();
                                dueDate.setDate(dueDate.getDate() + 14);
                                console.log(dueDate);
                                date = dateFormat(date);
                                dueDate = dateFormat(dueDate);
                                var newLoan = '<tr>' +
                                    '<td class="options hidden">' +
                                    '<input class="items" type="checkbox" value="' + data.ln_id + '">' +
                                    '<input type="hidden" name="ln_bk_id" value="' + book + '">' +
                                    '</td>' +
                                    '<td>' + userName + '</td>' +
                                    '<td>' + bookName + '</td>' +
                                    '<td>' + date + '</td>' +
                                    '<td>' + dueDate + '</td>' +
                                    '<td style="text-align:center"><i class="fa fa-smile-o" style="color:green; font-size:22px"></i></td>' +
                                    '</tr>';
                                //Check items
                                if (isEmpty($('#table').children('tbody').children().length)) {
                                    $('#p').remove();
                                    $('#table').empty();
                                    var thead = '<thead>' +
                                        '<tr>' +
                                        '<th class="options hidden">' +
                                        '<input id="check-all" type="checkbox">' +
                                        '</th>' +
                                        '<th>Usuário</th>' +
                                        '<th>Livro</th>' +
                                        '<th>Data de empréstimo</th>' +
                                        '<th>Data de devolução</th>' +
                                        '<th style="text-align:center">Situação</th>' +
                                        '</tr>' +
                                        '</thead>';
                                    $('#table').append(thead);
                                    $('#table').append('<tbody class="table-body">' + newLoan + '</tbody>');
                                    $("#open-options").removeClass('hidden');
                                } else {
                                    $('.table-body').append(newLoan);
                                }
                                $("#btn-delete").on("click", onClickBtnDelete);
                                $('#check-all').on("click", checkAll);
                            },
                            error: function (response) {
                                console.log(response);
                            }
                        });
                    });

                    $(".decline-request").on("click", function () {
                        var row = $(this).closest('tr');
                        var notificationId = row.children().val();

                        $.ajax({
                            url: '/decline/' + notificationId,
                            method: 'post',
                            data: {
                                _token: token,
                                _method: 'delete',
                            },
                            success: function (data) {
                                row.remove();
                                var empty = isEmpty($('#request-table').children('tbody').children().length - 1);
                                if (empty) {
                                    $('#request-table').empty();
                                    $('#request-table').append('<p>Nenhum pedido pendente</p>');
                                }
                            },
                            error: function (data) {
                                console.log('moises');
                            }
                        });
                    });

                    $(".accept-request").on("click", function () {
                        $('.options').addClass('hidden');
                        var row = $(this).closest('tr');
                        var notificationId = row.children().val();
                        var user = row.children('.user-value').text();
                        var book = row.children('.book-value').text();

                        $.ajax({
                            url: '/accept/' + notificationId,
                            method: 'post',
                            data: {
                                _token: token,
                                _method: 'delete',
                            },
                            success: function (data) {
                                console.log('success');
                                //Delete row from notifications
                                row.remove();
                                var empty = isEmpty($('#request-table').children('tbody').children().length - 1);
                                if (empty) {
                                    $('#request-table').empty();
                                    $('#request-table').append('<p>Nenhum pedido pendente</p>');
                                }

                                //Add row at loans
                                var date = new Date();
                                var dueDate = new Date();
                                dueDate.setDate(dueDate.getDate() + 14);
                                date = dateFormat(date);
                                dueDate = dateFormat(dueDate);
                                var newLoan = '<tr>' +
                                    '<td class="options hidden icheck">' +
                                        '<input class="items" type="checkbox" value="' + data.ln_id + '">' +
                                        '<input type="hidden" name="ln_bk_id" value="' + data.ln_bk_id + '">' +
                                    '</td>' +
                                    '<td>' + user + '</td>' +
                                    '<td>' + book + '</td>' +
                                    '<td>' + date + '</td>' +
                                    '<td>' + dueDate + '</td>' +
                                    '<td style="text-align:center">' +
                                        '<i class="fa fa-smile-o" style="color:green; font-size:22px"></i>' +
                                    '</td>' +
                                    '</tr>';
                                //Check items
                                if (isEmpty($('#table').children('tbody').children().length)) {
                                    $('#p').remove();
                                    $('#table').empty();
                                    var thead = '<thead>' +
                                        '<tr>' +
                                        '<th class="options hidden icheck">' +
                                        '<input id="check-all" type="checkbox">' +
                                        '</th>' +
                                        '<th>Usuário</th>' +
                                        '<th>Livro</th>' +
                                        '<th>Data de empréstimo</th>' +
                                        '<th>Data de devolução</th>' +
                                        '<th style="text-align:center">Situação</th>' +
                                        '</tr>' +
                                        '</thead>';
                                    $('#table').append(thead);
                                    $('#table').append('<tbody class="table-body">' + newLoan + '</tbody>');
                                    $('#open-options').removeClass('hidden');
                                    $(".options").toggleClass("hidden");
                                } else {
                                    $('.table-body').append(newLoan);
                                }
                                $('#check-all').on('ifChecked', onClickCheck);
                                $("#btn-delete").on("click", onClickBtnDelete);
                                $('input').iCheck({
                                    checkboxClass: 'icheckbox_square-blue',
                                    radioClass: 'iradio_square-blue',
                                    increaseArea: '20%' // optional
                                });
                                $('#check-all').on('ifChecked', onClickCheck);
                            },
                            error: function (data) {
                                console.log('moises');
                            }
                        });
                    });
                });
            </script>
@endsection