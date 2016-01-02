@extends('app')

@section('content')

<div class="container">
    <div class="col-md-10 ">
<table class="table table-striped">
    <h1>Aktywne ogłoszenia</h1>
    <thead>
        <tr>
            <th>Tytuł:</th>
            <th>Dodany:</th>
            <th>Wygasa:</th>
            <th>Akcja:</th>
        </tr>
    </thead>
    <tbody style="font-size: small">
        @foreach ($adverts as $advert)
        <tr>
            <th>{{ $advert->title }}</th>
            <th>{{ $advert->created_at }}</th>
            <th>{{ $advert->expired_at }}</th>
            <th width="2%"><a href="{{ url('/adverts', $advert->id)}}"><div class="btn btn-primary" style="margin: 3px">Zobacz</div></a></th>
            <th width="2%"><a href="{{ url('/adverts/'.$advert->id.'/edit')}}"><div class="btn btn-primary" style="margin: 3px">Edytuj</div></th>
            
            
             <th width="2%">   
                  {{ Form::open(array('route' => array('advert.destroy', $advert->id), 'method' => 'delete')) }}
                    <button class="btn btn-danger" type="submit" >Usun</button>
                    {{ Form::close() }}
            </th>      
                
        </tr>
        @endforeach
            </tbody>
</table>
        
        
        <h1>Wygasłe ogłoszenia</h1>
        <table class="table table-striped ">
    <thead>
        <tr>
            <th>Tytuł:</th>
            <th>Dodany:</th>
            <th>Wygasa:</th>
            <th>Akcja:</th>
        </tr>
    </thead>
    <tbody style="font-size: small">
        @foreach ($advertsExpired as $advert)
        <tr>
            <th>{{ $advert->title }}</th>
            <th>{{ $advert->created_at }}</th>
            <th>{{ $advert->expired_at }}</th>
            
            <th width="2%"><a href="{{ url('/adverts', $advert->id)}}"><div class="btn btn-primary" style="margin: 3px">Zobacz</div></a></th>
            <th width="2%"><a href="{{ url('/adverts/'.$advert->id.'/edit')}}"><div class="btn btn-primary" style="margin: 3px">Edytuj</div></th>
            <th width="2%">   
                  {{ Form::open(array('route' => array('advert.destroy', $advert->id), 'method' => 'delete')) }}
                    <button class="btn btn-danger" type="submit" >Usun</button>
                    {{ Form::close() }}
            </th>
        </tr>
        @endforeach
    </tbody>
</table>
    </div>
</div>
@endsection
