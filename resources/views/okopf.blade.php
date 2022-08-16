@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Коды ОКОПФ</h2>
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
            @forelse($okopf_codes as $okopf_code)
                <tr>
                    <td>
                        {{$okopf_code->code}}
                    </td>
                    <td>
                        {{$okopf_code->title}}
                    </td>
                </tr>
            @empty
                <h2>Nothing founded</h2>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection