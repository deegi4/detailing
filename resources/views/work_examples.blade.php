@extends('layouts.app', ['title' => 'Work Examples'])

@section('content')
<div>
    {{--
    <loop-slider
            :images="{{json_encode($images)}}"

    ></loop-slider>
    --}}
    <thumbs-gallery-loop
            :images="{{json_encode($images)}}"
            :height="0.8"

    ></thumbs-gallery-loop>
    {{--
    <h3>IMGS</h3>
    <ul>
        @foreach($images as $img)
            <li>
                <img src="{{$img}}">
            </li>
        @endforeach
    </ul>
    --}}
</div>
@endsection