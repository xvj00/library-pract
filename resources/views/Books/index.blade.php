@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="text-end mb-3">
            <a href="{{ route('book.create') }}" class="btn btn-primary">Создать</a>
            <a href="{{ route('author.create') }}" class="btn btn-primary">Добавить автора</a>
            <a href="{{ route('genre.create') }}" class="btn btn-primary">Добавить жанр</a>
            <a href="{{ route('edition.create') }}" class="btn btn-primary">Добавить издание</a>
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
                                    {{ $author->name }} {{ $author->surname }}, Возраст: {{$author->age}}
                                @endforeach
                            </p>

                            <p class="card-text">
                                Жанры: {{ $book->genres->pluck('title')->implode(', ') }}
                            </p>
                            <p class="card-text">
                                Издательство:

                                {{ $book->edition ? $book->edition->title : 'Не указано' }}

                            </p>
                            <p class="card-text">Описание: {{ $book->description }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('book.show', $book->id) }}" class="btn btn-info">Просмотреть</a>
                                <a href="{{ route('book.edit', $book->id) }}" class="btn btn-warning">Изменить</a>
                                <form action="{{ route('book.destroy', $book->id) }}" method="post" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>
                                <!-- Форма бронирования -->



                                @if((!$book->isReserved()) && (!$book->isConfirmed()))
                                    <form action="{{ route('reservations.store', ['book_id' => $book->id]) }}"
                                          method="post" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Забронировать</button>
                                    </form>
                                @elseif($book->isConfirmed())
                                    <button class="btn btn-secondary" disabled>Книги нет в наличии</button>
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
