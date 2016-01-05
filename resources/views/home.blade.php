@extends('app')

@section('content')
<div class="jumbotron">
    <center><h1 style="font-size: xx-large">AdCeg - ogłoszenia akademickie Politechniki Opolskiej</h1></center><hr/>
    <p style="text-align: justify">Portal ogłoszeniowy <b>AdCeg</b> powstał z myślą o studentach Politechniki Opolskiej mieszkających w akademikach. Znajdziesz tutaj odpowiednio oznaczone ogłoszenia skierowane do całej braci akademickiej, tak jak na facebooku - tylko że wszystko jest uporządkowane. Sam sprawdź!</p>
    @if (Auth::guest())
    <p>PS. Pamiętaj, że aby w pełni korzystać z serwisu należy się zarejestrować.</p>
    @endif
    <center><a class="btn btn-primary btn-lg" href="/adverts" role="button">Przeglądaj ogłoszenia</a> 
    @if(Auth::guest())
    <a class="btn btn-primary btn-lg" href="/register" role="button">Przeglądaj ogłoszenia</a>
    @endif
    </center>
</div>
@endsection
