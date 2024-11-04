@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Создать книгу</h1>
        <hr>
        <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" name="title" class="form-control" placeholder="Название" value="{{ old('title') }}">
                @error('title')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea name="description" class="form-control"
                          placeholder="Описание">{{ old('description') }}</textarea>
                @error('description')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="author_id" class="form-label">Автор</label>
                <select name="author_id" class="form-select">
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }} {{ $author->surname }}</option>
                    @endforeach
                </select>

            </div>

            <div class="mb-3">
                <label for="genre_id" class="form-label">Жанры</label>
                <select name="genre_id[]" multiple="multiple" class="form-select">
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                    @endforeach
                </select>

            <div class="mb-3">
                <label for="edition_id" class="form-label">Издания</label>
                <select name="edition_id" class="form-select">
                    @foreach($editions as $edition)
                        <option value="{{ $edition->id }}">{{ $edition->title}} </option>
                    @endforeach
                </select>

            </div>


            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Изображение книги</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Добавить в базу данных</button>
            </div>
        </form>
    </div>
@endsection
