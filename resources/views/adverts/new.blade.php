@extends('app')

@section('content')

<div class="container">
    <div class="col-md-6 col-md-offset-3">
    <h1>Witaj!</h1>
    
@include('errors.errors')
    
    {!! Form::open(['url' => 'adverts']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Tytuł:') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('content', 'Treść ogłoszenia:') !!}
            {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('contact', 'Kontakt:') !!}
            {!! Form::text('contact', null, ['placeholder' => '(np. telefon, email, nr pokoju)', 'class' => 'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('expired_at', 'Data ważności:') !!}
            {!! Form::input('date', 'expired_at', date('Y-m-d'), ['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('tags_list', 'Tagi:') !!}
            {!! Form::select('tags_list[]', $tags, null, ['id' => 'tags_list', 'class' => 'form-control', 'multiple']) !!}
        </div>
    
    
    


        <div class="form-group">
            <div class="row">
                <div class="col-md-5">{!! Form::submit('Dodaj', ['class' => 'btn btn-primary form-control']) !!}</div>
                <div class="col-md-5 col-md-offset-2"><a href="/" class="btn btn-primary form-control">Anuluj</a></div>
            </div>
            
        </div>
    {!! Form::close() !!}
    @section('footer')
    
    <script>    $('#tags_list').select2({
        placeholder: "Wybierz conajmniej jeden tag lub dodaj własny.",
                tags: true
    }); </script>
    @endsection
    </div>
</div>

@endsection
