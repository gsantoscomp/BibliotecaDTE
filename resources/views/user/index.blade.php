@extends('layouts.user')

@section('profileBox')
    <!-- Profile Image -->
    <div class="col-md-2">
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
@endsection

@section('myTabs')
    <div class="col-md-10">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#books" data-toggle="tab">Livros Disponíveis</a></li>
                <li><a href="#loans" data-toggle="tab">Meus Empréstimos</a></li>
                <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="books">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Editora</th>
                                <th>Proprietário</th>
                                <th>Descrição</th>
                            </tr>
                            </thead>
                            <tbody class="table-body">
                            @foreach($books as $book)
                                <tr>
                                    <td>{{ $book->bk_title }}</td>
                                    <td>{{ $book->bk_author }}</td>
                                    <td>{{ $book->bk_publisher }}</td>
                                    <td>{{ $book->bk_owner }}</td>
                                    <td>{{ $book->bk_description }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="loans">

                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputName" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
@endsection
