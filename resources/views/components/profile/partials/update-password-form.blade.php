<section class="p-6 bg-white shadow-lg rounded-lg border border-gray-200">
    <header>
        <h2 class="text-2xl font-semibold text-gray-800">
            Обновление пароля
        </h2>
        <p class="mt-2 text-base text-gray-600">
            Убедитесь, что ваш аккаунт использует надежный, случайный пароль для безопасности.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <!-- Текущий пароль -->
        <div>
            <label for="current_password" class="block text-lg font-medium text-gray-700">Текущий пароль</label>
            <input id="current_password" name="current_password" type="password" class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-green-500" autocomplete="current-password" required>
            @error('current_password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Новый пароль -->
        <div>
            <label for="password" class="block text-lg font-medium text-gray-700">Новый пароль</label>
            <input id="password" name="password" type="password" class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-green-500" autocomplete="new-password" required>
            @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Подтверждение пароля -->
        <div>
            <label for="password_confirmation" class="block text-lg font-medium text-gray-700">Подтвердите пароль</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-green-500" autocomplete="new-password" required>
            @error('password_confirmation')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Кнопка сохранения -->
        <div class="flex items-center gap-4 mt-4">
            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition">Сохранить</button>
            @if (session('status') === 'password-updated')
                <p class="text-green-500">Пароль успешно обновлен!</p>
            @elseif (session('status') === 'password-error')
                <p class="text-red-500">Ошибка при обновлении пароля.</p>
            @endif

        </div>
    </form>
</section>
