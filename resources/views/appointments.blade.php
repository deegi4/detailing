@extends('layouts.app')

@section('content')
<div>
{{--
    <ul>
        @foreach($carClasses as $carClass)
            <li data-id="{{$carClass->id}}">{{$carClass->name}}</li>
        @endforeach
    </ul>
--}}

{{--    <example-component></example-component>--}}
{{--v1--}}
    <appointments
{{--            :car-classes="{{json_encode($carClasses)}}"--}}
{{--            :price-list="{{json_encode($priceList)}}"--}}
{{--            :date-list="{{json_encode($dateList)}}"--}}
    ></appointments>

{{--v2--}
    @foreach($priceList as $carClass)
        <div id="carClass-{{$carClass['id']}}">
            <h3>{{$carClass['name']}}</h3>
            @foreach($carClass['service_types'] as $service_type)
                <h3>{{$service_type['name']}}</h3>
                @foreach($service_type['jobs'] as $job)
                    <div data-entity="job" data-id="{{$job['id']}}">
                        {{$job['name']}} = {{$job['price']}} $
                    </div>
                @endforeach
            @endforeach
        </div>
    @endforeach
{{----}}



{{--v3--}
    @foreach($carClasses as $carClass)
        <div id="carClass-{{$carClass->id}}">
        <h3>{{$carClass->name}}</h3>
            @foreach($serviceTypes as $serviceType)
                <h3>{{$serviceType->name}}</h3>
                @foreach($serviceType->jobs->where('car_class_id', $carClass->id) as $job)
                    <div data-entity="job" data-id="{{$job->id}}">
                        {{$job->service->name}} = {{$job->price}} $
                    </div>
                @endforeach
            @endforeach
        </div>
    @endforeach
{{----}}

</div>
@endsection