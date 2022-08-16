@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 vertical-form">
                <div class="bank-button client-fields"><i class="fa fa-university" aria-hidden="true"></i></div>
                <div class="client-button bank-fields"><i class="fa fa-user" aria-hidden="true"></i></div>
                <h2>Работодатель</h2>
                @if(Auth::user()->company_id)
                    <h2>Уже привязана компания</h2>
                @else
                    <label for="emp-okopf">Правовая форма</label>
                    <select id="emp-okopf" class="form-control">
                        @foreach($okopfs as $okopf)
                            <option value="{{$okopf->code}}">{{$okopf->title}}</option>
                        @endforeach
                    </select>
                    <label for="emp-company-name" style="display: none" id="emp-company-name-label">Название</label>
                    <input type="text" class="form-control" id="emp-company-name" value="" style="display: none">
                    <!--label for="emp-company-inn">ИНН</label-->
                    <input type="hidden" class="form-control" id="emp-company-inn" value="">
                    <br>
                    <button class="btn btn-primary" id="emp-company-button">Найти</button>
                    <div id="emp-msg" class="alert"></div>
                @endif
            </div>
        </div>
    </div>
@endsection