@extends('layout')

@section('title_postfix', ': конвертер из валюты в RUR')

@section('content')
    <div class="center">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @else
            @isset($result)
                <h5>Результат:</h5>
                {{ $amount  }} {{ $currency }} = {{ $result }} RUR
            @endisset
        @endif
    </div>
@endsection
