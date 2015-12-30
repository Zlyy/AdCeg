@extends('app')

@section('content')

{{ Auth::user()->name }}

@endsection
