<header class="main-header">

    <a href="{{url('/')}}" class="logo">
        <span class="logo-mini">DTE</span>
        <span class="logo-lg">DTE - Livros</span>
    </a>

    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><a><i class="fa fa-user-circle-o"></i> Olá, {{Auth::user()->name}}</a></li>
                <li>
                    <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-unlock-alt"></i> Sair do sistema</a>
                    </a>
                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                        <input name="_token" value="{{csrf_token()}}" type="hidden">
                    </form>
                </li>
            </ul>
        </div>
    </nav>

</header>