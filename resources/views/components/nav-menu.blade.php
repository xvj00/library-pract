<div class="flex w-full items-center p-4 bg-white rounded-lg">
    <!-- Изображение профиля -->
    @auth()
    <img src="{{ auth()->user()->getFirstMediaUrl('user_images') }}" class=" object-cover w-16 h-16 rounded-full border-2 border-gray-300 " alt="Профиль">
    @else
        <img src="{{asset('img/man.svg') }}" class="w-16 h-16 rounded-full border-2 border-gray-300 " alt="Профиль">

    @endauth
    <div class="flex-1 ml-4 flex flex-col items-center text-gray-800">
        <p class="text-lg font-semibold tracking-wider text-gray-700">Профиль</p>

        <!-- Условие: если пользователь авторизован, показываем ссылку на личный кабинет, иначе - кнопки "Вход" и "Регистрация" -->
        @auth
            <!-- Ссылка на личный кабинет -->
            <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline mt-2">Личный кабинет</a>
        @else
            <!-- Кнопки Вход и Регистрация -->
            <div class="flex space-x-4 mt-2">
                <a href="{{ route('login') }}" class="px-4 py-2 bg-green-500 text-white rounded-md shadow-md hover:bg-green-600 transition">
                    Вход
                </a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 transition">
                    Регистрация
                </a>
            </div>
        @endauth
    </div>
</div>

@vite('resources/js/app.js')
