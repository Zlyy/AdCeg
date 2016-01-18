<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">AdCeg</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/adverts') }}">Ogłoszenia</a></li>

                @if (Auth::check())

                <li><a href="{{ url('adverts/owned') }}">Moje ogłoszenia</a></li> </li>
                @endif<li><a href="{{ url('adverts/create') }}">Dodaj ogłoszenie</a></li>
                <li><a href="{{ url('contact') }}">Kontakt</a></li>

              
            </ul>
            
                {!! Form::open(array('action' => 'AdvertsController@searchAdverts', 'class' => 'navbar-form navbar-left')) !!}
                    {!! Form::text('search', null, ['class' => 'form-control', 'required' => 'required']) !!}
                
                {!! Form::submit('Szukaj', ['class' => 'btn btn-default' ]) !!}
                    {!! Form::close() !!}



            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Zaloguj</a></li>
                <li><a href="{{ url('/register') }}">Zarejestruj</a></li>
                @else

                @if (Auth::user()->admin === 1)
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Admin <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/admin/users') }}"><i class="fa fa-btn fa-sign-out"></i>Zarządzaj kontami</a></li>
                        <li><a href="{{ url('/admin/adverts') }}"><i class="fa fa-btn fa-sign-out"></i>Zarządzaj ogłoszeniami</a></li>
                        <li><a href="{{ url('/admin/tags') }}"><i class="fa fa-btn fa-sign-out"></i>Zarządzaj tagami</a></li>
                    </ul>
                </li>
                @endif

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/user/edit/'.Auth::user()->id) }}"><i class="fa fa-btn fa-sign-out"></i>Edytuj profil</a></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Wyloguj</a></li>

                    </ul>

                </li>
                @endif
            </ul>



        </div>
    </div>
</nav>