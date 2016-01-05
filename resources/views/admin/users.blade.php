@extends('app')

@section('content')

<div class="container">
    <div class="col-md-10 ">

<h1>Zarządzanie użytkownikami</h1><hr/>

<table class="table table-striped">
    
    
    <thead>
        <tr>
            <th>Nazwa:</th>
            <th>Email:</th>
            <th>Utworzony:</th>
            <th>Akcja:</th>
        </tr>
    </thead>
    <tbody style="font-size: small">
        @foreach ($users as $user)
        <tr>
            <th width="40%">{{ $user->name }}</th>
            <th>{{ $user->email }}</th>
            <th>{{ $user->created_at }}</th>
            <th width="2%"><a href="{{ url('user/'.$user->id.'/owned')}}"><div class="btn btn-primary" style="margin: 3px">Zobacz ogłoszenia</div></a></th>
            <th width="2%"><a href="{{ url('/user/edit/'.$user->id)}}"><div class="btn btn-primary" style="margin: 3px">Edytuj</div></th>
            
            
             <th width="2%">   
                  {{ Form::open(array('route' => array('user.destroy', $user->id), 'method' => 'delete', 'onsubmit' =>'return confirm("Czy na pewno chcesz usunąć tego użytkownika?");')) }}
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
