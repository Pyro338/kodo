@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Поиск: Люди</h3>
                <label for="ur-surname">Фамилия</label>
                <input type="text" class="form-control" id="ur-surname" value="">
                <label for="ur-name">Имя</label>
                <input type="text" class="form-control" id="ur-name" value="">
                <label for="ur-thirdname">Отчество</label>
                <input type="text" class="form-control" id="ur-thirdname" value="">
                <label for="ur-inn">ИНН</label>
                <input type="text" class="form-control" id="ur-inn" value="">
                <br>
                <button class="btn btn-primary" id="ur-person-button">Проверить</button>
                <div id="ur-person-msg" class="alert"></div>
                <h3>Поиск: Организация</h3>
                <label for="ur-company-name">Название</label>
                <input type="text" class="form-control" id="ur-company-name" value="">
                <label for="ur-company-ogrn">ОГРН</label>
                <input type="text" class="form-control" id="ur-company-ogrn" value="">
                <label for="ur-company-inn">ИНН</label>
                <input type="text" class="form-control" id="ur-company-inn" value="7810470840">
                <label for="ur-company-kpp">КПП</label>
                <input type="text" class="form-control" id="ur-company-kpp" value="">
                <br>
                <button class="btn btn-primary" id="ur-company-button">Проверить</button>
                <div id="ur-company-msg" class="alert"></div>
            </div>
        </div>
    </div>
@endsection