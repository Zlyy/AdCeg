@extends('app')

@section('content')


<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1>Zarządzanie tagami:</h1><hr/>
        
<table class="table table-striped">
<thead>
        <tr>
            <th>Tag:</th>
            <th>Utworzony:</th>
            <th>Akcja:</th>
        </tr>
</thead>
<tbody style="font-size: small">
@foreach ($tags as $tag)
    <tr>
        <th width="25%">{{$tag->name}}</th>
       
        <th width="25%">{{ $tag->created_at }}</th>
        
        <th width="2%"><a href='{{url('/tags', $tag->name)}}'><div class="btn btn-primary" style="margin: 3px">Ogłoszenia</div></a></th>
        
       <th width="2%"> {{ Form::open(array('route' => array('tags.destroy', $tag->id), 'method' => 'delete', 'onsubmit' =>'return confirm("Czy na pewno chcesz skasować ten tag?");')) }}
                    <button class="btn btn-danger" type="submit" >Usuń</button>
                    {{ Form::close() }}</th>
    </tr>
    @endforeach
    
</tbody>                                                
</table>
</div>
    </div>

@endsection