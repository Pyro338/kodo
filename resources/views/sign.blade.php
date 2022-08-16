@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <label for="cyr-text">Ваше имя</label>
                <input type="text" class="form-control" id="sign-name">
                <label for="lat-text">E-mail</label>
                <input type="text" class="form-control" id="sign-email">
                <br>
                <button class="btn btn-primary" id="sign-button">Отправить</button>
                <div id="sign-msg" class="alert"></div>
            </div>
        </div>
    </div>
@endsection