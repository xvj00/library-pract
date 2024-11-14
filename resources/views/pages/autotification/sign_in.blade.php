<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">

<main class="flex justify-center items-center min-h-screen py-6">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md mx-auto">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Регистрация</h1>

        <form action="{{ route('register') }}" method="POST" class="space-y-4"  enctype="multipart/form-data">
            @csrf

            <div>
                <label for="name" class="block text-lg text-gray-700">ФИО:</label>
                <input name="name" id="name" type="text" value="{{ old('name') }}" required
                       class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-lg text-gray-700">Почта:</label>
                <input name="email" id="email" type="email" value="{{ old('email') }}"
                        required
                       class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('email')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-lg text-gray-700">Пароль:</label>
                <input name="password" id="password" type="password" required
                       class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('password')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-lg text-gray-700">Подтвердите пароль:</label>
                <input name="password_confirmation" id="password_confirmation" type="password" required
                       class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('password_confirmation')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Аватар</label>
                <input
                    type="file"
                    name="image"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
            </div>

            <button type="submit"
                    class="w-full py-3 mt-6 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                Зарегистрироваться
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="/log_in" class="text-green-500 font-semibold hover:text-green-700">Уже есть аккаунт? Войти</a>
        </div>
    </div>
</main>

</body>
</html>
