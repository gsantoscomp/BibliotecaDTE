@extends('layouts.admin')

@section('title')
    Usuários
@endsection

@section('subtitle')
    Gerenciar
@endsection

@section('thTable')
    <th class="options hidden">
        <input id="check-all" type="checkbox">
    </th>
    <th>Nome</th>
    <th>Email</th>
    <th>Privilégio</th>
@endsection

@section('tableBody')
    @foreach($users as $user)
        <tr>
            <td class="options hidden">
                <input class="items" type="checkbox" value="{{ $user->id }}">
            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if($user->role == 'Admin')
                    <span class="label label-success">{{ $user->role }}</span>
                @else
                    <span class="label label-primary">{{ $user->role }}</span>
                @endif
            </td>
        </tr>
    @endforeach
@endsection

@section('button')
    <a class="btn btn-sm btn-primary btn-flat pull-right" id="add">
        Adicionar Usuário
        &ensp;<i class="fa fa-plus"></i>
    </a>
@endsection
@section('modalForm')
    <div class="form-group">
        <label for="name" class="control-label">Usuário:</label>
        <input type="text" class="form-control" name="name" id="name">
    </div>
    <div class="form-group">
        <label for="email" class="control-label">Email:</label>
        <input type="text" class="form-control" name="email" id="email">
    </div>
    <div class="form-group">
        <label for="password" class="control-label">Senha:</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    {{--<div class="form-group">--}}
        {{--<label for="password" class="control-label">Confirmar senha:</label>--}}
        {{--<input type="password" class="form-control" name="confirm-password" id="confirm-password">--}}
    {{--</div>--}}
@endsection

@section('url')
    "/user/"
@endsection

@section('cols')
    <div class="col-md-6">
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function()
        {
            //Add user
            $("#btn-confirm").on("click", function(e)
            {
                e.preventDefault();

                var name = $("#name").val(); console.log(name);
                var email = $("#email").val(); console.log(email);
                var password = $("#password").val(); console.log(password);

                $.ajax({
                    url : "/user",
                    method : "POST",
                    data : {
                        _token : token,
                        name : name,
                        email : email,
                        password : password
                    },
                    success: function(data){
                        $("#modal-add").modal("toggle");
                        data = data[0];
                        var newUser = '<tr>' +
                            '<td class="options hidden">'+
                            '<input class="items" type="checkbox" value="'+ data.id +'">' +
                            '</td>' +
                            '<td>' + name + '</td>' +
                            '<td>' + email + '</td>' +
                            '<td><span class="label label-primary">User</span></td>' +
                            '</tr>';
                        //Check items
                        if(isEmpty($('#table').children('tbody').children().length)){
                            $('#p').remove();
                            $('#table').empty();
                            var thead = '<thead>' +
                                '<tr>' +
                                '<th class="options hidden">' +
                                '<input id="check-all" type="checkbox">' +
                                '</th>' +
                                '<th>Nome</th>' +
                                '<th>Email</th>' +
                                '<th>Privilégio</th>' +
                                '</tr>' +
                                '</thead>';
                            $('#table').append(thead);
                            $('#table').append('<tbody class="table-body">' + newUser + '</tbody>');
                        } else {
                            $('.table-body').append(newUser);
                        }
                        $("#btn-delete").on("click", onClickBtnDelete);
                        $("#check-all").on("click", checkAll);
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection
