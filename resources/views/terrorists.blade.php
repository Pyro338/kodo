@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Реестр террористов</h2>
        <table class="table">
            <thead>
            <tr>
                <th>
                    ФАМИЛИЯ
                </th>
                <th>
                    ИМЯ
                </th>
                <th>
                    ОТЧЕСТВО
                </th>
                <th>
                    ДАТА РОЖДЕНИЯ
                </th>
                <th>
                    МЕСТО РОЖДЕНИЯ
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($terrorists as $terrorist)
                <tr>
                    <td>
                        {{$terrorist->surname}}
                    </td>
                    <td>
                        {{$terrorist->name}}
                    </td>
                    <td>
                        {{$terrorist->thirdname}}
                    </td>
                    <td>
                        {{$terrorist->birthdate}}
                    </td>
                    <td>
                        {{$terrorist->birthplace}}
                    </td>
                </tr>
            @empty
                <h2>Nothing founded</h2>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        {{$terrorists->links()}}
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection