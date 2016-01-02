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
            <li><a href="{{ url('') }}">Kontakt</a></li>
            
          </ul>
            
            
           
            <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/user/edit/'.Auth::user()->id) }}"><i class="fa fa-btn fa-sign-out"></i>Edytuj profil</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                
                            </ul>
                            
                        </li>
                    @endif
                </ul>
            
          
            
        </div>
      </div>
    </nav>