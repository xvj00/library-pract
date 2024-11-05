<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Личный кабинет') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold">{{ __("Добро пожаловать в ваш личный кабинет!") }}</h3>
                    <p class="mt-2">{{ __("Здесь вы можете управлять своими бронированиями и просматривать информацию о своих книгах.") }}</p>

                    <div class="mt-6">
                        <!-- Ссылки на различные разделы личного кабинета -->
                        <div class="space-y-4">
                            <a href="{{ route('reservation.user.index') }}"
                               class="block text-lg text-black hover:text-black/70 dark:text-white dark:hover:text-white/80">
                                Мои бронирования
                            </a>
                            <a href="{{ route('profile.edit') }}"
                               class="block text-lg text-black hover:text-black/70 dark:text-white dark:hover:text-white/80">
                                Мой профиль
                            </a>
                            <a href="{{ route('book.index') }}"
                               class="block text-lg text-black hover:text-black/70 dark:text-white dark:hover:text-white/80">
                                Все книги
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
