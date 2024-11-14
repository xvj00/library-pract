@extends('pages.library-man.index')

@section('content')
    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold text-center text-green-700 mb-6">Создать книгу</h1>
        <hr class="mb-6">

        <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Book Title -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Название</label>
                <input
                    type="text"
                    name="title"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                    placeholder="Введите название книги"
                    value="{{ old('title') }}">
                @error('title')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Описание</label>
                <textarea
                    name="description"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                    placeholder="Введите описание книги">{{ old('description') }}</textarea>
                @error('description')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Author -->
            <div class="mb-4">
                <label for="author_id" class="block text-sm font-medium text-gray-700 mb-1">Автор</label>
                <select
                    name="author_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }} {{ $author->surname }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Genres -->
            <div class="mb-4">
                <label for="genre_id" class="block text-sm font-medium text-gray-700 mb-1">Жанры</label>
                <select
                    name="genre_id[]"
                    multiple
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Edition -->
            <div class="mb-4">
                <label for="edition_id" class="block text-sm font-medium text-gray-700 mb-1">Издания</label>
                <select
                    name="edition_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                    @foreach($editions as $edition)
                        <option value="{{ $edition->id }}">{{ $edition->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Book Image -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Изображение книги</label>
                <input
                    type="file"
                    name="image"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-6">
                <button
                    type="submit"
                    class="px-6 py-2 text-white bg-green-600 rounded-md shadow-md hover:bg-green-700 transition-colors duration-200">
                    Добавить в базу данных
                </button>
            </div>
        </form>
    </div>
@endsection
