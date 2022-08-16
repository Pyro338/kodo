@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Коды субъектов РФ</h2>
    <table class="table">
        <thead>
        <tr>
            <th>
                НАИМЕНОВАНИЕ СУБЪЕКТА РФ
            </th>
            <th>
                КОД СУБЪЕКТА
            </th>
            <th>
                КОД ГАИ/ГИБДД
            </th>
            <th>
                КОД ОКАТО и ОКТМО
            </th>
            <th>
                КОД ISO 3166-2 И ГОСТ 7.67-2003
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($regions as $region)
        <tr>
            <td>
                {{$region->name}}
            </td>
            <td>
                {{$region->code}}
            </td>
            <td>
                {{$region->gibdd}}
            </td>
            <td>
                {{$region->okato}}
            </td>
            <td>
                {{$region->gost}}
            </td>
        </tr>
        @empty
        <h2>Nothing founded</h2>
        @endforelse
        </tbody>
    </table>
</div>
@endsection