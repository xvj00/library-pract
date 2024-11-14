<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
<header class="w-full bg-green-500 text-white py-4">
    <div class="container mx-auto flex justify-between items-center px-6">
        <h1 class="text-2xl font-bold">Профиль</h1>
        <nav class="space-x-4">
            <a href="/" class="hover:underline">Главная</a>

            <!-- Форма для выхода из системы -->
            <form action="{{ route('logout') }}" method="POST" class="inline-block">
                @csrf
                <button type="submit" class="text-white hover:underline">Выход</button>
            </form>
        </nav>
    </div>
</header>

<main class="container mx-auto mt-8 px-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Боковое меню -->
        <aside class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Меню</h2>
            <ul class="space-y-3 text-gray-700">
                <li><a href="{{ route('reservation.user.index') }}" class="hover:text-green-500">Мои заказы</a></li>
            </ul>
        </aside>

        <!-- Основной контент -->
        <section class="col-span-2 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Добро пожаловать, {{ auth()->user()->name }}</h2>

            <!-- Информация о пользователе -->
            <div class="mb-6">
                <p class="text-gray-800"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p class="text-gray-800"><strong>Дата регистрации:</strong> {{ auth()->user()->created_at->format('d.m.Y') }}</p>
                <p class="text-gray-800"><strong>Роль:</strong> {{ auth()->user()->role === 'admin' ? 'Администратор' : (auth()->user()->role === 'librarian' ? 'Библиотекарь' : 'Пользователь')}}</p>
            </div>

            <div class="mb-6 flex items-center">
                <div>
                    <img src="{{ auth()->user()->getFirstMediaUrl('user_images') ?: asset('img/default-avatar.png') }}" class="object-cover w-24 h-24 rounded-full border-2 border-gray-300" alt="Аватар">
                </div>
                <form action="{{ route('profile.imageUpdate') }}" method="POST" enctype="multipart/form-data" class="ml-4">
                    @csrf
                    @method('PATCH')
                    <label for="avatar" class="block text-sm font-medium text-gray-700">Изменить аватар</label>
                    <input type="file" name="image" id="image" accept="image/*" class="block w-full text-sm text-gray-500 mt-1">
                    <button type="submit" class="mt-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Сохранить</button>
                </form>
            </div>

            <!-- Включение дополнительных форм -->
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
            @include('profile.partials.delete-user-form')
        </section>
    </div>
</main>

@vite('resources/js/app.js')
</body>
</html>
