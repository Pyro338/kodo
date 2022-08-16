@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <label for="cardnumber">Введите номер карты</label>
                <input type="text" class="form-control" id="cardnumber" value="5536 9137 6356 2499">
                <br>
                <button class="btn btn-primary" id="cardnumber-button">Отправить</button>
                <br>
                <div id="cardnumber-msg" class="alert"></div>
            </div>
        </div>
    </div>
@endsection