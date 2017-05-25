@extends('layouts.user')

@section('profileBox')
    <!-- Profile Image -->
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="https://www.1pcom.net/img/loginhead.jpg"
                     alt="User profile picture">

                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                <p class="text-muted text-center">Colaborador</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Empréstimos Requeridos</b> <a id="openRequests" class="pull-right">{{ $openRequests }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Livros Pendentes</b> <a class="pull-right">{{ $overdue }}</a>
                    </li>
                </ul>

            </div>
            <!-- /.box-body -->
        </div>
    </div>
@endsection

@section('myTabs')
    <div class="col-md-8">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#books" data-toggle="tab">Solicitar Livro</a></li>
                <li><a href="#loans" data-toggle="tab">Meus Empréstimos</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="books">
                    <div class="table-responsive">
                        <table id="table" class="table no-margin">
                            <thead>
                            <tr>
                                @if(count($books) > 0)
                                    <th>Título</th>
                                    <th>Autor</th>
                                    <th>Editora</th>
                                    <th style="text-align: center">Opções</th>
                                @else
                                    <p id="p">Nenhum livro disponível para empréstimo</p>
                                @endif
                            </tr>
                            </thead>
                            <tbody id="tbody" class="table-body">
                            @foreach($books as $book)
                                <tr id="{{ $book->bk_id }}" class="requestRow">
                                    <td>{{ $book->bk_title }}</td>
                                    <td>{{ $book->bk_author }}</td>
                                    <td>{{ $book->bk_publisher }}</td>
                                    <td style="text-align: center">
                                        <a class="btn btn-success bookRequest"> Solicitar</a>
                                        <a data-toggle="modal" data-target="#modal-{{ $book->bk_id }}"
                                           class="btn btn-info bookInfo"> Info </a>
                                    </td>
                                </tr>

                                {{-- Modal --}}
                                <div class="modal fade" id="modal-{{ $book->bk_id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
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
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                    Fechar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right" style="margin-right: 40px">{{ $books->links() }}</div>
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="loans">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                @if(count($loans) > 0)
                                    <th>Livro</th>
                                    <th>Data de empréstimo</th>
                                    <th>Data de devolução</th>
                                    <th style="text-align:center">Situação</th>
                                @else
                                    <p id="p">Nenhum empréstimo efetuado</p>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="table-body">
                            @foreach($loans as $loan)
                                <tr>
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
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer clearfix">

                    </div>
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
            var aux = 0;

            $(".bookRequest").on("click", function () {
                aux++;
                var row = $(this).closest('tr');
                var bookId = row.attr('id');
                var requests = {{ $openRequests }};

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
                        requests += aux;
                        $("#openRequests").html(requests);
                        row.remove();
                        var empty = isEmpty($("#tbody").children().length);
                        if (empty) {
                            $('#table').empty();
                            $('#table').append('<p>Nenhum livro disponível para empréstimo</p>');
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection

@section('styles')
    <style type="text/css" rel="stylesheet">
        ul .active {
            color: red !important;
        }
    </style>
@endsection
