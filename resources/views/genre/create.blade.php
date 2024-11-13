@extends('pages.library-man.index')

@section('content')
    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-md max-w-lg">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-semibold text-green-700">Добавление Жанра</h2>
            <p class="text-gray-600">Введите информацию о новом жанре в библиотеку</p>
        </div>

        <form action="{{ route('genre.store') }}" method="post" class="space-y-4">
            @csrf
            <!-- Название жанра -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Название жанра</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                    placeholder="Введите название жанра"
                    value="{{ old('title') }}">
                @error('title')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Кнопка отправки -->
            <div class="text-center mt-6">
                <button
                    type="submit"
                    class="px-6 py-2 bg-green-600 text-white rounded-md shadow-md hover:bg-green-700 transition-colors duration-200">
                    Отправить
                </button>
            </div>
        </form>
    </div>
@endsection
