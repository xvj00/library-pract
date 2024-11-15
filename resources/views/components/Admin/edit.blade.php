@extends('pages.admin.index')

@section('content')
    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold text-center text-green-700 mb-6">Обновление пользователя</h1>
        <hr class="mb-6">

        <form action="{{ route('admin.update', $admin) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Поле для пароля -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Пароль</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                @error('password')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Поле для подтверждения пароля -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Подтвердите
                    пароль</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                @error('password_confirmation')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Роль</label>
                <select id="role" name="role" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                    <option value="librarian" {{ $admin->role === 'librarian' ? 'selected' : '' }}>Библиотекарь</option>
                    <option value="user" {{ $admin->role === 'user' ? 'selected' : '' }}>Пользователь</option>
                </select>
                @error('role')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>


            <!-- Кнопка отправки -->
            <div class="text-center mt-6">
                <button
                    type="submit"
                    class="px-6 py-2 text-white bg-green-600 rounded-md shadow-md hover:bg-green-700 transition-colors duration-200">
                    Обновить
                </button>
            </div>
        </form>
    </div>
@endsection
