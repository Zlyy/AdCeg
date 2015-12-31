@extends('app')

@section('content')


<div class ='container'>
    <div class='panel-group'>
        <div class="col-md-8 col-md-offset-2"><h1>Najnowsze ogłoszenia</h1> </div><br/><br/>
        @foreach ($adverts as $advert)

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                
                
                <div class="col-md-4"></div>
                <div class="panel-heading">{{ $advert->title }} <span class="date">Dodany {{ $advert->created_at }} przez TODO.</span></div>

                <div class="panel-body">{{ $advert->content }}</div>
                <div class="panel-body"><span class="more"><a href='{{ url('/adverts', $advert->id)}}'>Czytaj więcej</a></div></span>
                <div class="panel-footer">Tagi: lol, lol2, lol3</div>
            </div>
                </div>
        </div>
        <br/><br/>
        
        


        @endforeach
    </div>
</div>


@endsection