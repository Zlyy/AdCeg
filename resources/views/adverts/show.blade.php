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
                    <a href='{{url('/tags', $tag->name)}}'>{{ $tag->name .' '}}</a>
                    @endforeach

                    <span class="more">Ważne do: {{$advert->expired_at}}</span></div>
            </div>
        </div>
    </div>
</div>

@if(\Auth::guest())
<h2 style="text-align: center; color: #B0BEC5">Aby skontaktować się z autorem musisz być zalogowany</h2>
@else
@if(!(\Auth::user()->id === $advert->user_id))

<div class='row'>
    <div class="col-md-8 col-md-offset-2">
        <h1>Skontaktuj się z {{\App\User::find($advert->user_id)->name}}</h1>

        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>

        {!! Form::open(array('route' => 'contact_advert_store', 'class' => 'form')) !!}


        <div class="form-group">
            {!! Form::label('Twoja wiadomość') !!}
            {!! Form::textarea('message', null, 
            array('required', 
            'class'=>'form-control', 
            'placeholder'=>'Treść wiadomości')) !!}
            {{ Form::hidden('author_id', $advert->user_id) }}
            {{ Form::hidden('title', $advert->title) }}
        </div>

        <center><div class="form-group">
                {!! Form::submit('Wyślij wiadomość!', 
                array('class'=>'btn btn-primary')) !!}
            </div></center>
        {!! Form::close() !!}
    </div>
</div>
@endif
@endif



@endsection