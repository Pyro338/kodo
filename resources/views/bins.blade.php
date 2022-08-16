@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>BIN коды банков</h2>
        <table class="table">
            <thead>
            <tr>
                <th>
                    BIN
                </th>
                <th>
                    ПЛАТЕЖНАЯ СИСТЕМА
                </th>
                <th>
                    ВЫДАНА БАНКОМ
                </th>
                <th>
                    ТИП КАРТЫ
                </th>
                <th>
                    КАТЕГОРИЯ КАРТЫ
                </th>
                <th>
                    СТРАНА
                </th>
            </tr>
            </thead>
            <tbody>
        @forelse($bins as $bin)
            <tr>
                <td>
                    {{$bin->bin}}
                </td>
                <td>
                    {{$bin->brand}}
                </td>
                <td>
                    {{$bin->issuer}}
                </td>
                <td>
                    {{$bin->type}}
                </td>
                <td>
                    {{$bin->category}}
                </td>
                <td>
                    {{$bin->country_name}}
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
                        {{$bins->links()}}
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection