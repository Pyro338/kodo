@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <label for="cyr-text">Введите имя на кириллице</label>
            <input type="text" class="form-control" id="cyr-text">
            <label for="lat-text">Введите имя на латинице</label>
            <input type="text" class="form-control" id="lat-text">
            <br>
            <button class="btn btn-primary" id="check-transliteration-button">Сравнить</button>
            <div id="transliterate-msg" class="alert"></div>
            <div class="test"></div>
        </div>
    </div>
</div>
@endsection
