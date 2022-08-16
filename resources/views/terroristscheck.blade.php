@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Поиск по базе террористов</h3>
                <label for="ter-surname">Фамилия</label>
                <input type="text" class="form-control" id="ter-surname" value="" required>
                <label for="ter-name">Имя</label>
                <input type="text" class="form-control" id="ter-name" value="" required>
                <label for="ter-thirdname">Отчество</label>
                <input type="text" class="form-control" id="ter-thirdname" value="">
                <br>
                <button class="btn btn-primary" id="ter-button">Проверить</button>
                <div id="ter-msg" class="alert"></div>
            </div>
        </div>
    </div>
@endsection