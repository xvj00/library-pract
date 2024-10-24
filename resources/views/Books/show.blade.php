@extends('layout.main')

@section('content')


    <div>

        <hr>
        <div>
            <div>Name: {{ $book -> name }}</div>
            <div>Surname: {{ $book -> surname }}</div>
            <div>Email: {{ $book -> email }}</div>
            <div>Age: {{$book -> age}}</div>
            <div>Decription: {{ $book -> description }}</div>



                <a href="{{ route('book.index') }}">Назад</a>
        </div>
        <hr>




</div>

@endsection
