@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 vertical-form"">
                <div class="bank-button client-fields"><i class="fa fa-university" aria-hidden="true"></i></div>
                <div class="client-button bank-fields"><i class="fa fa-user" aria-hidden="true"></i></div>
                <h2>Работодатель</h2>
                @if(Auth::user()->company_id)
                    <h2>Уже привязана компания</h2>
                @else
                    <label for="emp2-type">Выберите тип работодателя</label>
                    <select id="emp2-type" class="form-control">
                        <option value="0"></option>
                        <option value="1">Организация</option>
                        <option value="2">Индивидуальный предприниматель</option>
                    </select>
                    <div class="emp2-ip-block">
                        <label for="emp2-surname">Фамилия</label>
                        <input type="text" class="form-control" id="emp2-surname" value="Шаповал">
                        <label for="emp2-name">Имя</label>
                        <input type="text" class="form-control" id="emp2-name" value="Антон">
                        <label for="emp2-thirdname">Отчество (не обязательно)</label>
                        <input type="text" class="form-control" id="emp2-thirdname" value="">
                        <label for="emp2-inn">ИНН (не обязательно)</label>
                        <input type="text" class="form-control" id="emp2-inn" value="">
                        <br>
                        <button class="btn btn-primary" id="emp2-person-button">Найти</button>
                        <div id="emp2-person-msg" class="alert"></div>
                    </div>
                    <div class="emp2-org-block">
                        <label for="emp2-company-name">Название</label>
                        <input type="text" class="form-control" id="emp2-company-name" value="">
                        <label for="emp-2-add-params">Хотите ввести дополнительные параметры для поиска?</label>
                        <select id="emp-2-add-params" class="form-control">
                            <option value="0"></option>
                            <option value="1">ОГРН</option>
                            <option value="2">ИНН</option>
                            <option value="3">КПП</option>
                        </select>
                        <br>
                        <input type="text" class="form-control" id="emp2-company-ogrn" value="">
                        <input type="text" class="form-control" id="emp2-company-inn" value="">
                        <input type="text" class="form-control" id="emp2-company-kpp" value="">
                        <br>
                        <button class="btn btn-primary" id="emp2-company-button">Найти</button>
                        <div id="emp2-company-msg" class="alert"></div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection