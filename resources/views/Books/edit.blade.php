@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Изменить книгу</h1>
        <hr>
        <form action="{{ route('book.update', $book->id) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" name="title" class="form-control" placeholder="Название" value="{{ old('title') ?? $book->title }}">
                @error('title')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea name="description" class="form-control" placeholder="Описание">{{ old('description') ?? $book->description }}</textarea>
                @error('description')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Автор</label>
                <input type="text" name="author" class="form-control" placeholder="Автор" value="{{ old('author') ?? $book->author }}">
                @error('author')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Изменить</button>
            </div>
        </form>
    </div>
@endsection
