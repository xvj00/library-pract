<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    @vite('resources/css/app.css')
</head>
<body id="app">
<!-- Шапка сайта -->
<header class="w-full bg-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="border-b-2 border-green px-[3%] py-4">
            <div class="header grid grid-cols-[1fr_2fr_1fr] items-center">
                <!-- Логотип и меню навигации -->
                @include('components/nav-menu')

                <!-- Основные ссылки -->
                <nav class="flex justify-center space-x-6">
                    <a href="/" class="text20_10 text-gray-700 hover:text-green-600 transition">Главная</a>
                    <a href="/catalog" class="text20_10 text-gray-700 hover:text-green-600 transition">Каталог</a>

                    <a href="#new-arrivals" class="text20_10 text-gray-700 hover:text-green-600 transition">Новинки</a>
                    <a href="#reviews" class="text20_10 text-gray-700 hover:text-green-600 transition">Отзывы</a>
                    @auth()
                        @if(auth()->user()->role ==='admin')
                    <a href="{{route('admin.index')}}" class="text20_10 text-gray-700 hover:text-green-600 transition">Админ Панель</a>
                        @endif
                    @endauth

                    @auth()
                        @if(auth()->user()->role ==='librarian')
                            <a href="{{route('reservations.index')}}" class="text20_10 text-gray-700 hover:text-green-600 transition">Библотекарь</a>
                        @endif
                    @endauth
                </nav>

                <!-- Корзина и поиск -->
                <div class="flex items-center space-x-4 justify-end">
                    <!-- Корзина -->
                    <div id="cart">
                        <btn-cart></btn-cart>
                    </div>
                    <!-- Поиск -->
                    <form class="relative w-full max-w-[250px]">
                        @csrf
                        <input
                            type="text"
                            name="search-input"
                            class="input_search input_search_h70 w-full px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 placeholder-gray-500 text32_12"
                            placeholder="Поиск"
                        >
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

@vite('resources/js/app.js')
</body>
</html>
