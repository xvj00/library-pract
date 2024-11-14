@extends('pages.library-man.index')

@section('content')
    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-md max-w-lg">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-semibold text-green-700">Создание автора</h2>
            <p class="text-gray-600">Введите имя, фамилию и возраст автора</p>
        </div>

        <form action="{{ route('author.store') }}" method="post" class="space-y-4">
            @csrf
            <!-- Поле для имени -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Имя</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                    placeholder="Введите имя"
                    value="{{ old('name') }}">
                @error('name')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Поле для фамилии -->
            <div class="mb-4">
                <label for="surname" class="block text-sm font-medium text-gray-700 mb-1">Фамилия</label>
                <input
                    type="text"
                    id="surname"
                    name="surname"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                    placeholder="Введите фамилию"
                    value="{{ old('surname') }}">
                @error('surname')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Поле для возраста -->
            <div class="mb-4">
                <label for="age" class="block text-sm font-medium text-gray-700 mb-1">Возраст</label>
                <input
                    type="number"
                    id="age"
                    name="age"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                    placeholder="Введите возраст">
                @error('age')
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
