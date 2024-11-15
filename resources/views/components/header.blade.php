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
            <div class="header grid grid-cols-3 md:grid-cols-[1fr_2fr_1fr] items-center">
                <!-- Логотип и меню навигации -->
                <div class="flex justify-between items-center col-span-3 md:col-span-1">
                    @include('components/nav-menu')
                    <!-- Кнопка меню для мобильных -->
                    <button id="mobile-menu-toggle" class="md:hidden focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Основные ссылки -->
                <nav id="nav-menu" class="hidden md:flex flex-col md:flex-row justify-center space-x-0 md:space-x-6 col-span-3 md:col-span-2 mt-4 md:mt-0">
                    <a href="/" class="text20_10 text-gray-700 hover:text-green-600 transition">Главная</a>
                    <a href="/catalog#catalog" class="text20_10 text-gray-700 hover:text-green-600 transition">Каталог</a>
                    <a href="/#new-arrivals" class="text20_10 text-gray-700 hover:text-green-600 transition">Новинки</a>
                    <a href="/#reviews" class="text20_10 text-gray-700 hover:text-green-600 transition">Отзывы</a>
                    @auth()
                        @if(auth()->user()->role === 'admin')
                            <a href="{{route('admin.index')}}" class="text20_10 text-gray-700 hover:text-green-600 transition">Админ Панель</a>
                        @endif
                    @endauth

                    @auth()
                        @if(auth()->user()->role === 'librarian')
                            <a href="{{route('reservations.index')}}" class="text20_10 text-gray-700 hover:text-green-600 transition">Библиотекарь</a>
                        @endif
                    @endauth
                </nav>

                <!-- Поиск -->
{{--                <div class="flex w-full justify-center md:justify-end col-span-3 md:col-span-1 mt-4 md:mt-0">--}}
{{--                    <form class="relative w-full md:w-auto max-w-[250px]">--}}
{{--                        @csrf--}}
{{--                        <input--}}
{{--                            type="text"--}}
{{--                            name="search-input"--}}
{{--                            class="input_search input_search_h70 w-full px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 placeholder-gray-500 text32_12"--}}
{{--                            placeholder="Поиск"--}}
{{--                        >--}}
{{--                    </form>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</header>

<!-- Скрипт для мобильного меню -->
<script>
    document.getElementById('mobile-menu-toggle').addEventListener('click', function () {
        const navMenu = document.getElementById('nav-menu');
        navMenu.classList.toggle('hidden');
    });
</script>


</body>
</html>
