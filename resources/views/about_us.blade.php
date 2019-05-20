@extends('layouts.app', ['title' => 'О нас', 'id' => 'about'])

@section('no-vue')
<div class="container">
    <div class="card">
        <div class="row card-body">
            <div class="col">
                <h5 class="card-title">Режим работы:</h5>
                <p class="card-text">10:00 - 21:00 без выходных</p>
                <h5 class="card-title">Адресс</h5>
                <p class="card-text">Тутаевское шоссе, д.93а</p>
            </div>
            <div class="col">
                <h5 class="card-title">Контакты:</h5>
                <p class="card-text">8(496)333-33-33</p>
                <p class="card-text">8(496)444-44-44</p>

            </div>
            {{--
            <img src="img/detailing_map.jpg">
            --}}
        </div>
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Adabb80ac4944257c857bda3040ec77a12af3d5be1837b0028f23fb3adc1f6c2d&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=false"></script>
    </div>
</div>

@endsection