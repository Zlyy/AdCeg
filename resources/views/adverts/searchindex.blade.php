@extends('app')

@section('content')



<div class="row">
    <div class="col-md-9">


        <h1>Wyniki szukania dla frazy:<i> {{ $input }}</i></h1><hr/> <br/><br/>


        @if(count($adverts)>0)
        <div class="row">
            @foreach ($adverts as $advert)
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-primary">


                    <div class="col-md-4"></div>
                    <div class="panel-heading">{{ $advert->title }} <span class="date">Dodany {{ $advert->created_at }} przez {{ \App\User::find($advert->user_id)->name}} </span></div>
@if($advert->image)
                <div class="image"><img src="{{ url($advert->image) }}"></div>
                @endif
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
        @else
        <h2 style="text-align: center; color: #B0BEC5">Brak wyników</h2>

        @endif

    </div>
    <br/><br/><br/><br/>
    @if(count($tags)>0)
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Znalezione tagi:</h3>
                </div>

                <div class="panel-body">
                    @foreach ($tags as $tag)
                    <span style="font-size: larger"><a href='{{url('/tags', $tag->name)}}'>{{ $tag->name .' '}}</a></span>
                    @endforeach</div>
            </div>
        </div>

    </div>
    @endif
</div>

</div>




@endsection