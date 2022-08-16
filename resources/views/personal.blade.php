@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Паспортные данные</h1>
                <form action="{{route('personalUpdate')}}"  method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="put">
                    <table class="table table-stripped">
                        <tbody>
                        <tr>
                            <td>
                                Фамилия
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{$user->passport_second_name}}" name="passport_second_name">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Имя
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{$user->passport_first_name}}" name="passport_first_name">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Отчество
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{$user->passport_third_name}}" name="passport_third_name">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Серия
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{$user->passport_series}}" name="passport_series">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Номер
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{$user->passport_number}}" name="passport_number">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Выдан:
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{$user->passport_place_issue}}" name="passport_place_issue">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Дата выдачи
                            </td>
                            <td>
                                <input type="date" class="form-control" value="{{$user->passport_date_issue}}" name="passport_date_issue">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Код подразделения
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{$user->passport_code_issue}}" name="passport_code_issue">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Пол
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{$user->passport_sex}}" name="passport_sex">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Дата рождения
                            </td>
                            <td>
                                <input type="date" class="form-control" value="{{$user->passport_birth_date}}" name="passport_birth_date">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Место рождения
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{$user->passport_birth_place}}" name="passport_birth_place">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Прописка
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{$user->passport_registration}}" name="passport_registration">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <input type="submit" value="Сохранить" class="btn btn-primary" name="submit">
                </form>
            </div>
        </div>
    </div>
@endsection
