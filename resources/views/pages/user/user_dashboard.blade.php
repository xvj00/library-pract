<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
<header class="w-full bg-green-500 text-white py-4">
    <div class="container mx-auto flex justify-between items-center px-6">
        <h1 class="text-2xl font-bold">Личный кабинет</h1>
        <nav class="space-x-4">
            <a href="/" class="hover:underline">Главная</a>
            <a href="{{ route('profile.edit') }}" class="hover:underline">Настройки</a>
            <a href="{{ route('logout') }}" class="hover:underline">Выход</a>
        </nav>
    </div>
</header>

<main class="container mx-auto mt-8 px-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Боковое меню -->
        <aside class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Меню</h2>
            <ul class="space-y-3 text-gray-700">
                <li><a href="{{ route('profile.edit') }}" class="hover:text-green-500">Профиль</a></li>
{{--                <li><a href="{{ route('user.orders') }}" class="hover:text-green-500">Мои заказы</a></li>--}}
{{--                <li><a href="{{ route('user.favorites') }}" class="hover:text-green-500">Избранное</a></li>--}}
{{--                <li><a href="{{ route('user.settings') }}" class="hover:text-green-500">Настройки</a></li>--}}
            </ul>
        </aside>

        <!-- Основной контент -->
        <section class="col-span-2 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Добро пожаловать, {{ Auth::user()->name }}</h2>

            <!-- Информация о пользователе -->
            <div class="mb-6">
                <p class="text-gray-800"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p class="text-gray-800"><strong>Дата регистрации:</strong> {{ Auth::user()->created_at->format('d.m.Y') }}</p>
            </div>


            @include('profile.partials.update-password-form')
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.delete-user-form')
        </section>
    </div>
</main>

@vite('resources/js/app.js')
</body>
</html>
