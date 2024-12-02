<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <title>Сброс пароля</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-3xl font-semibold text-center text-green-700 mb-6">Сброс пароля</h1>

    <form action="{{ route('password.resetUpdate') }}" method="POST" class="space-y-4">
        @csrf
        <!-- Токен -->
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Поле для ввода email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Ваш Email</label>
            <input
                type="email"
                id="email"
                name="email"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                placeholder="Введите ваш email"
                required>
            @error('email')
            <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Поле для нового пароля -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Новый пароль</label>
            <input
                type="password"
                id="password"
                name="password"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                placeholder="Введите новый пароль"
                required>
            @error('password')
            <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Поле для подтверждения пароля -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Подтверждение
                пароля</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                placeholder="Подтвердите пароль"
                required>
            @error('password_confirmation')
            <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Кнопка отправки -->
        <div>
            <button
                type="submit"
                class="w-full py-3 px-6 bg-green-600 text-white font-semibold rounded-md shadow hover:bg-green-700 transition duration-200">
                Сбросить пароль
            </button>
        </div>
    </form>
</div>
</body>
</html>
