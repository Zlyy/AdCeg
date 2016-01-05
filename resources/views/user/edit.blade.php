@extends('app')

@section('content')

<div class="container">
    <div class="col-md-6 col-md-offset-3">
    <h1>Konto użytkownika {!! $user->name !!}</h1>
    <hr/>
    
    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id]]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Imię:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('dormitory', 'Akademik:') !!}
            {!! Form::text('dormitory', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Adres email:') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-5">{!! Form::submit('Zapisz', ['class' => 'btn btn-primary form-control']) !!}</div>
                <div class="col-md-5 col-md-offset-2"><a href="/" class="btn btn-primary form-control">Anuluj</a></div>
            </div>
            
        </div>
    {!! Form::close() !!}
        <div class="form-group">
            <div class="row">
                <div class="col-md-12"><a href="{{ url('/user/edit/password/'.$user->id) }}" class="btn btn-primary form-control">Zmień hasło</a></div>
            </div>
        </div>
    @if (Auth::user()->admin === 1 || ($user->id)=== Auth::id())
    <div class="form-group">
            {{ Form::open(array('route' => array('user.destroy', $user->id), 'method' => 'delete', 'onsubmit' =>'return confirm("Czy na pewno chcesz to konto?");')) }}
                    <button class="btn btn-danger" type="submit" >Usun</button>
                    {{ Form::close() }}
     </div>
    @endif
    </div>
</div>

@endsection
