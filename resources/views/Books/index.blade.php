@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="text-end mb-3">
            <a href="{{ route('book.create') }}" class="btn btn-primary">Создать</a>
        </div>

        <div class="row">
            @foreach($books as $book)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <img src="{{ $book->getFirstMediaUrl('book_images') }}" class="card-img-top"
                             alt="Обложка книги">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">
                                Автор:
                                @foreach($book->authors as $author)
                                    {{ $author->name }} {{ $author->surname }}
                                @endforeach
                            </p>

                            <p class="card-text">
                                Жанры:
                                @foreach($book->genres as $genre)
                                   | {{ $genre->title }} |
                                @endforeach
                            </p>
                            <p class="card-text">
                                Издательство:

                                {{ $book -> edition ->title }}

                            </p>
                            <p class="card-text">Описание: {{ $book->description }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('book.show', $book->id) }}" class="btn btn-info">Просмотреть</a>
                                <a href="{{ route('book.edit', $book->id) }}" class="btn btn-warning">Изменить</a>
                                <form action="{{ route('book.destroy', $book->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>
                                <!-- Форма бронирования -->

                                                @if(!$book->isReserved())
                                                    <form
                                                        action="{{ route('reservations.store', ['book_id' => $book->id]) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Забронировать
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-secondary" disabled>Забронировано</button>
                                                @endif


                                            </div>
                                        </div>
                                    </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="my-nav">
                            {{$books->withQueryString()->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
@endsection
