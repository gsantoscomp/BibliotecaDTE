@extends('layouts.user')

@section('profileBox')
    <!-- Profile Image -->
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="https://www.1pcom.net/img/loginhead.jpg"
                     alt="User profile picture">

                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                <p class="text-muted text-center">Colaborador</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Empréstimos Requeridos</b> <a class="pull-right">22</a>
                    </li>
                    <li class="list-group-item">
                        <b>Livros Pendentes</b> <a class="pull-right">2</a>
                    </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Editar</b></a>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-1"></div>
@endsection

@section('myTabs')
    <div class="col-md-1"></div>
    <div class="col-md-7">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#books" data-toggle="tab">Solicitar Livro</a></li>
                <li><a href="#loans" data-toggle="tab">Meus Empréstimos</a></li>
                <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="books">
                    {{--<div class="box-header clearfix">Selecione um livro.</div>--}}
                    <div class="table-responsive">
                        <table id="table" class="table no-margin">
                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Editora</th>
                                <th style="text-align: center">Opções</th>
                            </tr>
                            </thead>
                            <tbody class="table-body">
                            @foreach($books as $book)
                                <tr id="{{ $book->bk_id }}" class="requestRow">
                                    <td>{{ $book->bk_title }}</td>
                                    <td>{{ $book->bk_author }}</td>
                                    <td>{{ $book->bk_publisher }}</td>
                                    <td style="text-align: center">
                                        <a class="btn btn-success bookRequest"> Solicitar</a>
                                        <a data-toggle="modal" data-target="#modal-{{ $book->bk_id }}" class="btn btn-info bookInfo"> Info </a>
                                    </td>
                                </tr>

                                {{-- Modal --}}
                                <div class="modal fade" id="modal-{{ $book->bk_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">{{ $book->bk_title }}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <b>Autor:</b> <br> {{ $book->bk_author }}
                                                <hr>
                                                <b>Editora:</b> <br> {{ $book->bk_publisher }}
                                                <hr>
                                                <b>Proprietário:</b> <br> {{ $book->bk_owner }}
                                                <hr>
                                                <b>Descrição :</b> <br> {{ $book->bk_description }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <a id="request-loan" class="btn btn-sm btn-primary btn-flat pull-right hidden">
                            Solicitar Empréstimo
                            &ensp;<i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="loans">

                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">

                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var token = $("meta[name=csrf-token]").attr("content");
        function isEmpty(tableLength) {
            if (tableLength === 0) {
                return true;
            }
            else {
                return false;
            }
        }
        $(document).ready(function () {
            var userId = {{ Auth::id() }};

            $(".bookRequest").on("click", function () {
                var row = $(this).closest('tr');
                var bookId = row.attr('id');

                console.log(token + ' ' + userId + ' ' + bookId);
                $.ajax({
                    url: "/notification",
                    method: "post",
                    data: {
                        _token: token,
                        user_id: userId,
                        book_id: bookId,
                        type: 'request'
                    },
                    success: function (data) {
                        row.remove();
                        var empty = isEmpty($("tbody").children().length);
                        if (empty) {
                            $('#table').empty();
                            $('#table').append('<p>Nenhum livro disponível para empréstimo</p>');
                        }
                    },
                    error: function () {
                        console.log('moises');
                    }
                });
            });
        });
    </script>
@endsection

@section('styles')
    <style type="text/css" rel="stylesheet">

    </style>
@endsection
