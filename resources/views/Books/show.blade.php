@extends('layout.main')

@section('content')

    <div>

        <hr>
        <div>
            <div>Название: {{ $book -> title }}</div>
            <div>Автор книги:
                @foreach($book->authors as $author)
                    {{ $author->name}} {{ $author->surname}}
                @endforeach</div>
            <div>Описание: {{ $book -> description }}</div>


            <a href="{{ route('book.index') }}">Назад</a>
        </div>
        <hr>


    </div>

@endsection
