@extends('app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Formularz kontaktowy</h1>
            <p>Jeżeli podczas korzystania z serwisu napotkałeś jakiś błąd lub masz jakąś sugestię - skorzystaj z tego formularza.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>

        {!! Form::open(array('route' => 'contact_store', 'class' => 'form')) !!}

        <div class="form-group">
            {!! Form::label('Twoje imię') !!}
            {!! Form::text('name', null, 
            array('required', 
            'class'=>'form-control', 
            'placeholder'=>'Twoje imię')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Twój adres email') !!}
            {!! Form::text('email', null, 
            array('required', 
            'class'=>'form-control', 
            'placeholder'=>'Twój adres email')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Twoja wiadomość') !!}
            {!! Form::textarea('message', null, 
            array('required', 
            'class'=>'form-control', 
            'placeholder'=>'Twoja wiadomość')) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Wyślij!', 
            array('class'=>'btn btn-primary')) !!}
        </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection