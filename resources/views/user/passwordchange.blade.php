@extends('app')

@section('content')

<div class="container">
    <div class="col-md-6 col-md-offset-3">
    <h1>Witaj {!! $user->name !!}</h1>
    
    {!! Form::open(['method' => 'PATCH', 'action' => ['UserController@updatePassword', $user->id]]) !!}
  
        <div class="form-group">
            {!! Form::label('password', 'Wprowadź nowe hasło:') !!}
            {!! Form::text('password', null, ['class' => 'form-control']) !!}
        </div>
            
        <div class="form-group">
            <div class="row">
                <div class="col-md-5">{!! Form::submit('Zapisz', ['class' => 'btn btn-primary form-control']) !!}</div>
                <div class="col-md-5 col-md-offset-2"><a href="/" class="btn btn-primary form-control">Anuluj</a></div>
            </div>
            
        </div>
    {!! Form::close() !!}
    </div>
</div>

@endsection
