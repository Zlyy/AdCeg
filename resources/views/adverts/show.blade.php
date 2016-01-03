@extends('app')

@section('content')


<div class="container">
    <div class="row">
            <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                
                
                <div class="col-md-4"></div>
                <div class="panel-heading">{{ $advert->title }} <span class="date">Dodany {{ $advert->created_at }} przez {{ \App\User::find($advert->user_id)->name}}  </span></div>

                <div class="panel-body"><p>{{ $advert->content }}</p></div>
                <div class="panel-body">Kontakt: {{$advert->contact}}</div>
                <div class="panel-footer">Tagi: 
                    
                                                @foreach ($advert->tags as $tag)
                                                {{ $tag->name .' '}}
                                                @endforeach
                    
                    <span class="more">Ważne do: {{$advert->expired_at}}</span></div>
            </div>
                </div>
        </div>
</div>




@endsection