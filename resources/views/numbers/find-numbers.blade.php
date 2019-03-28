@extends('layout')

@section('title_postfix', ': поиск чисел')

@section('content')
    <div class="center">
        <form enctype="multipart/form-data" method="post">
            <label for="file">Файл:</label>
            <input type="file" name="file" id="file" required><br><br>
            <label for="digit">Цифра:</label>
            <input type="number" min="1" max="9" name="digit" value="4" id="digit" required><br><br>
            <input type="submit" value="Отправить">
            @csrf
        </form>
        @isset($result)
            <h5>Результат:</h5>
            {{ $result }}
        @endisset
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
