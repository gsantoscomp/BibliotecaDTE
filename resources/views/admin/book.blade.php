@extends('layouts.admin')

@section('title')
    Livros
@endsection

@section('subtitle')
    Gerenciar
@endsection

@section('modalForm')
    <div class="form-group">
        <label for="bk_title" class="control-label">Título:</label>
        <input type="text" class="form-control" name="bk_title" id="bk_title">
    </div>
    <div class="form-group">
        <label for="bk_author" class="control-label">Autor:</label>
        <input type="text" class="form-control" name="bk_author" id="bk_author">
    </div>
    <div class="form-group">
        <label for="bk_pub_id" class="control-label">Editora:</label>
        <input type="text" class="form-control" name="bk_publisher" id="bk_publisher">
    </div>
    <div class="form-group">
        <label for="bk_owner" class="control-label">Proprietário:</label>
        <input type="text" class="form-control" name="bk_owner" id="bk_owner">
    </div>
    <div class="form-group">
        <label for="bk_description" class="control-label">Descrição:</label>
        <textarea class="form-control" name="bk_description" id="bk_description"></textarea>
    </div>
@endsection

@section('button')
    <a class="btn btn-sm bg-aqua-active btn-flat pull-right" id="add">
        Adicionar Livro
        &ensp;<i class="fa fa-plus"></i>
    </a>
@endsection

@section('thTable')
    @if(count($books) > 0)
        <th class="options hidden icheck">
            <input id="check-all" type="checkbox">
        </th>
        <th>Título</th>
        <th>Autor</th>
        <th>Editora</th>
        <th>Dono</th>
        <th>Descrição</th>
        <th>Status</th>
    @else
        <p id="p">Não foram encontrados resultados</p>
    @endif
@endsection

@section('tableBody')
    @foreach ($books as $book)
        <tr>
            @if($book->bk_availability == 'disponivel')
            <td class="options hidden icheck">
                <input class="items" type="checkbox" value="{{ $book->bk_id }}">
            </td>
            @else
                <td class="options hidden">
                    <input type="checkbox" disabled>
                </td>
            @endif
            <td>{{ $book->bk_title }}</td>
            <td>{{ $book->bk_author }}</td>
            <td>{{ $book->bk_publisher }}</td>
            <td>{{ $book->bk_owner }}</td>
            <td>{{ $book->bk_description }}</td>
            <td>
                @if ($book->bk_availability == 'disponivel')
                    <span class="label label-success">Disponível</span>
                @else
                    <span class="label label-danger">Indisponível</span>
                @endif
            </td>
        </tr>
    @endforeach
@endsection

@section('url')
    "/book/"
@endsection

@section('cols')
    <div class="col-md-12">
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#btn-confirm").on("click", function(e){
                e.preventDefault();
                var title = $("#bk_title").val(); console.log(title);
                var author = $("#bk_author").val(); console.log(author);
                var publisher = $("#bk_publisher").val(); console.log(publisher);
                var owner = $("#bk_owner").val(); console.log(owner);
                var description = $("#bk_description").val(); console.log(description);
                var token = $("meta[name=csrf-token]").attr("content"); console.log(token);

                $.ajax({
                    url : "/book",
                    method : "POST",
                    data : {
                        _token : token,
                        bk_title : title,
                        bk_author: author,
                        bk_owner : owner,
                        bk_publisher : publisher,
                        bk_description : description
                    },
                    success: function(data){
                        $("#modal-add").modal("toggle");
                        data = data[0];
                        var newBook = '<tr>' +
                            '<td class="options hidden icheck">' +
                            '<input class="items" type="checkbox" value='+ data.bk_id +'>' +
                            '</td>' +
                            '<td>' + title + '</td>' +
                            '<td>' + author + '</td>' +
                            '<td>' + publisher + '</td>' +
                            '<td>' + owner + '</td>' +
                            '<td>' + description + '</td>' +
                            '<td>' +
                                '<span class="label label-success">Disponível</span>' +
                            '</td>' +
                        '</tr>';
                        console.log(newBook);
                        //Check items
                        if(isEmpty($('#table').children('tbody').children().length)){
                            $('#p').remove();
                            $('#table').empty();
                            var thead = '<thead>' +
                                '<tr>' +
                                '<th class="options hidden icheck">' +
                                '<input id="check-all" type="checkbox">' +
                                '</th>' +
                                '<th>Título</th>' +
                                '<th>Autor</th>' +
                                '<th>Editora</th>' +
                                '<th>Dono</th>' +
                                '<th>Descrição</th>' +
                                '<th>Status</th>' +
                            '</tr>' +
                            '</thead>';

                            $('#table').append(thead);
                            $('#table').append('<tbody class="table-body">' + newBook + '</tbody>');
                            $("#open-options").removeClass('hidden');
                        } else {
                            $('.table-body').append(newBook);
                        }
                        $("#btn-delete").on("click", onClickBtnDelete);
                        $('input').iCheck({
                            checkboxClass: 'icheckbox_square-blue',
                            radioClass: 'iradio_square-blue',
                            increaseArea: '20%' // optional
                        });
                        $('#check-all').on('ifChecked', onClickCheck);
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            });
        });
    </script>

@endsection
