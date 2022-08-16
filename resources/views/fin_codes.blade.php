@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Коды финансовой отчетности</h2>
        <table class="table">
            <thead>
            <tr>
                <th>
                    КОД
                </th>
                <th>
                    ОПИСАНИЕ
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($fin_codes as $fin_code)
                <tr>
                    <td>
                        {{$fin_code->code}}
                    </td>
                    <td>
                        {{$fin_code->title}}
                    </td>
                </tr>
            @empty
                <h2>Nothing founded</h2>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection