@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Загрузить таблицу транслитерации:</h2>
                <form method="post" action="{{ route('lettersUpdate') }}" enctype="multipart/form-data">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input type="file" multiple name="file[]">
                    <button type="submit">Загрузить</button>
                </form>
                <h2>Текущие правила транслитерации:</h2>
                <table class="table table-stripped">
                    @foreach($letters as $key => $value)
                        <tr>
                            <th>
                                {{$key}}
                            </th>
                            @foreach($value as $letter)
                                <td>
                                    {{$letter}}
                                </td>
                            @endforeach
                            @if(count($value) < $row_length)
                                @for($i = 0; $i < $row_length - count($value); $i++)
                                    <td></td>
                                    @endfor
                                @endif
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection