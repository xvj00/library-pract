@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="text-end mb-3">
            <a href="{{ route('book.create') }}" class="btn btn-primary">Создать</a>
            <a href="{{ route('author.create') }}" class="btn btn-primary">Добавить автора</a>
            <a href="{{ route('genre.create') }}" class="btn btn-primary">Добавить жанр</a>
            <a href="{{ route('edition.create') }}" class="btn btn-primary">Добавить издание</a>
        </div>

        <!-- Форма фильтрации -->
        <form method="GET" action="{{ route('book.index') }}" class="container my-4">
            <div class="row g-3">
                <!-- Фильтр по автору -->
                <div class="col-md-3">
                    <label for="author" class="form-label">Автор</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Имя автора" value="{{ request('author') }}">
                </div>

                <!-- Фильтр по названию книги -->
                <div class="col-md-3">
                    <label for="title" class="form-label">Название книги</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Название книги" value="{{ request('title') }}">
                </div>

                <!-- Фильтр по жанру -->
                <div class="col-md-3">
                    <label for="genre" class="form-label">Жанр</label>
                    <select class="form-select" id="genre" name="genre">
                        <option value="">Все жанры</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Фильтр по изданию -->
                <div class="col-md-3">
                    <label for="edition" class="form-label">Издание</label>
                    <select class="form-select" id="edition" name="edition">
                        <option value="">Все издания</option>
                        @foreach($editions as $edition)
                            <option value="{{ $edition->id }}" {{ request('edition') == $edition->id ? 'selected' : '' }}>
                                {{ $edition->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Кнопки фильтрации и сброса -->
            <div class="row mt-3">
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Применить фильтр</button>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('book.index') }}" class="btn btn-secondary w-100">Сбросить фильтр</a>
                </div>
            </div>
        </form>

        <div class="row">
            @foreach($books as $book)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <img src="{{ $book->getFirstMediaUrl('book_images') }}" class="card-img-top" alt="Обложка книги">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">
                                <strong>Автор:</strong>
                                @foreach($book->authors as $author)
                                    {{ $author->name }} {{ $author->surname }} (Возраст: {{ $author->age }})
                                @endforeach
                            </p>

                            <p class="card-text">
                                <strong>Жанры:</strong> {{ $book->genres->pluck('title')->implode(', ') }}
                            </p>

                            <p class="card-text">
                                <strong>Издательство:</strong> {{ $book->edition ? $book->edition->title : 'Не указано' }}
                            </p>

                            <p class="card-text"><strong>Описание:</strong> {{ $book->description }}</p>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('book.show', $book->id) }}" class="btn btn-info">Просмотреть</a>
                                <a href="{{ route('book.edit', $book->id) }}" class="btn btn-warning">Изменить</a>

                                <!-- Удаление с подтверждением -->
                                <form action="{{ route('book.destroy', $book->id) }}" method="post" onsubmit="return confirm('Вы уверены, что хотите удалить эту книгу?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>

                                <!-- Форма бронирования -->
                                @if((!$book->isReserved()) && (!$book->isConfirmed()) && (!$book->isGiven()))
                                    <form action="{{ route('reservations.store', ['book_id' => $book->id]) }}" method="post" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Забронировать</button>
                                    </form>
                                @elseif($book->isGiven())
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

        <!-- Пагинация -->
        <div class="my-nav">
            {{ $books->withQueryString()->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
