@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Поиск по базе ФССП</h2>
                <h3>Поиск: Люди</h3>
                <label for="fssp-region">Регион</label>
                <select id="fssp-region" class="form-control">
                    @foreach($regions as $region)
                        <option value="{{$region->code}}">{{$region->name}}</option>
                    @endforeach
                </select>
                <label for="fssp-surname">Фамилия</label>
                <input type="text" class="form-control" id="fssp-surname" value="">
                <label for="fssp-name">Имя</label>
                <input type="text" class="form-control" id="fssp-name" value="">
                <label for="fssp-thirdname">Отчество</label>
                <input type="text" class="form-control" id="fssp-thirdname" value="">
                <label for="fssp-birthdate">Дата рождения</label>
                <input type="date" class="form-control" id="fssp-birthdate" value="">
                <br>
                <button class="btn btn-primary" id="fssp-person-button">Проверить</button>
                <input type="hidden" id="fssp-person-task">
                <div id="fssp-person-msg" class="alert"></div>
                <div id="fssp-person-status" class="alert"></div>
                <div id="fssp-person-result" class="alert"></div>
                <!--h3>Поиск: Организация</h3>
                <label for="fssp-company-name">Название</label>
                <input type="text" class="form-control" id="fssp-company-name" value="">
                <label for="fssp-company-ogrn">ОГРН</label>
                <input type="text" class="form-control" id="fssp-company-ogrn" value="">
                <label for="fssp-company-inn">ИНН</label>
                <input type="text" class="form-control" id="fssp-company-inn" value="">
                <label for="fssp-company-kpp">КПП</label>
                <input type="text" class="form-control" id="fssp-company-kpp" value="">
                <br>
                <button class="btn btn-primary" id="fssp-company-button">Проверить</button>
                <div id="fssp-company-msg" class="alert"></div-->
            </div>
        </div>
    </div>
@endsection