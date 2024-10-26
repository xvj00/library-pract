@extends('layouts.main')

@section('content')

    <div>
        <hr>

        <div>
            <a href="{{route('book.create')}}">Создать</a>
        </div>

    </div>

    <div>
        <hr>

    </div>

    <div>
        @foreach($books as $book)
            <hr>
            <div>
                <div>Название книги: {{ $book -> title }}</div>
                <div>Автор книги:
                    @foreach($book->authors as $author)
                        {{ $author->name}} {{ $author->surname}}
                    @endforeach
                </div>
                <div>Описание: {{ $book -> description }}</div>

                <img src="{{ $book->getFirstMediaUrl('book_images') }}">



                <div>
                    <a href="{{route('book.show', $book -> id)}}">просмотреть</a>
                </div>


                <div>
                    <a href="{{route('book.edit', $book -> id)}}">Изменить</a>
                </div>


                <div>
                    <form action="{{route('book.destroy', $book -> id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Удалить">
                    </form>
                </div>


            </div>
            <hr>

        @endforeach
        <div class="my-nav">{{$books ->withQueryString() -> links()}}</div>
    </div>
@endsection
