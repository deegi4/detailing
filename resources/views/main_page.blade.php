@extends('layouts.app', ['title' => 'Детейлинг', 'id' => 'main'])

@section('content')
<div class="container-fluid">
{{--    <img src="img/main.jpg">--}}
 <div class="m-5 slogan">
     Сделаем кузов блестящим, <br>
     салон чистым.
 </div>
    <a class="m-5 btn btn-secondary btn-lg" href="{{ route('appointments') }}">
        Запись на приём
    </a>
</div>
@endsection