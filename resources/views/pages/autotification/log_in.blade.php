<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<main class="w-full max-w-md p-8 bg-white shadow-lg rounded-2xl border border-gray-200">
    <h1 class="text-center text-2xl font-bold text-gray-800 mb-6">Вход в аккаунт</h1>

    <form method="post" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Поле для ввода почты -->
        <label for="email" class="block text-lg text-gray-700">Почта</label>
        <input name="email" id="email" type="email" placeholder="example@mail.com" class="input_searth w-full h-12 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" required>

        <!-- Поле для ввода пароля -->
        <label for="password" class="block text-lg text-gray-700">Пароль</label>
        <input name="password" id="password" type="password" placeholder="••••••••" class="input_searth w-full h-12 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" required>

        <!-- Кнопка входа -->
        <button type="submit" class="w-full h-12 bg-green-500 text-white rounded-lg font-semibold shadow-lg hover:bg-green-600 transition-colors">
            Войти
        </button>

        <!-- Ошибки валидации -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 rounded-lg mt-4">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>

    <!-- Ссылка на регистрацию -->
    <div class="text-center mt-6">
        <p class="text-gray-600">Нет аккаунта?
            <a href="/sign_in" class="text-green-500 font-semibold hover:text-green-600 transition-colors">Регистрация</a>
        </p>
    </div>
</main>

</body>
</html>
