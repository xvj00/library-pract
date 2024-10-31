@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">{{ $book->title }}</h2>
            </div>
            <div class="card-body">
                <p class="card-text">
                    <strong>Автор книги:</strong>
                    @foreach($book->authors as $author)
                        {{ $author->name }} {{ $author->surname }}
                    @endforeach
                </p>
                <p class="card-text">
                    <strong>Описание:</strong> {{ $book->description }}
                </p>

                <p class="card-text">
                    <strong>Издательство:</strong>

                    {{ $book -> edition ->title }}

                </p>

                <img src="{{ $book->getFirstMediaUrl('book_images') }}" class="img-fluid" alt="Обложка книги">
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('book.index') }}" class="btn btn-secondary">Назад</a>
            </div>
        </div>
    </div>
@endsection
