@extends('layout')

@section('content')
    i am the home page
    @foreach ($departamente as $departament)
        <p>This is user {{ $departament->nume }}</p>
    @endforeach
@endsection
