@extends('app')

@section('content')



    <div class="row">
        <div class="col-md-9">
    
        
        <h1>Najnowsze ogłoszenia</h1><hr/> <br/><br/>
        
        <div class="row">
            @foreach ($adverts as $advert)
            
            <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-primary">
                
                
                <div class="col-md-4"></div>
                <div class="panel-heading">{{ $advert->title }} <span class="date">Dodany {{ $advert->created_at }} przez {{ \App\User::find($advert->user_id)->name}} </span></div>

                <div class="panel-body">{{ $advert->content }}</div>
                <div class="panel-body"><span class="more"><a href='{{ url('/adverts', $advert->id)}}'>Czytaj więcej</a></div></span>
                <div class="panel-footer">Tagi: @foreach ($advert->tags as $tag)
                    <a href='{{url('/tags', $tag->name)}}'>{{ $tag->name .' '}}</a>
                                                @endforeach</div>
            </div>
                </div>
        
        <br/><br/>
        @endforeach
        
        
        
        </div>
        <div class="col-md-offset-4">
    {{ $adverts->links() }}
 </div>
    </div>
        <br/><br/><br/>
        <div class="col-md-3">@include('partials.tags')</div>
    </div>



@endsection