@extends('layout', ['title' => 'Appointments'])

@section('content')
<div>
    <ul>
        @foreach($carClasses as $carClass)
            <li data-id="{{$carClass->id}}">{{$carClass->name}}</li>
        @endforeach
    </ul>
</div>
@endsection