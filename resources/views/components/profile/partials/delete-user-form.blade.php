<section class="space-y-6 p-6 bg-white shadow-lg rounded-lg border border-gray-200">
    <header>
        <h2 class="text-2xl font-semibold text-gray-800">
            Удаление аккаунта
        </h2>

        <p class="mt-2 text-base text-gray-600">
            Как только ваш аккаунт будет удален, все его ресурсы и данные будут удалены безвозвратно. Пожалуйста, загрузите все данные или информацию, которые хотите сохранить, перед удалением аккаунта.
        </p>
    </header>

    <!-- Кнопка удаления аккаунта -->
    <button onclick="document.getElementById('confirm-deletion-modal').classList.remove('hidden')"
            class="bg-red-600 text-white px-6 py-2 rounded-md hover:bg-red-700 transition">
        Удалить аккаунт
    </button>

    <!-- Модальное окно подтверждения удаления -->
    <div id="confirm-deletion-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg border border-gray-200">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h2 class="text-xl font-semibold text-gray-800 mb-4">
                    Вы уверены, что хотите удалить свой аккаунт?
                </h2>

                <p class="mb-4 text-gray-600">
                    После удаления вашего аккаунта все его ресурсы и данные будут удалены безвозвратно. Пожалуйста, введите ваш пароль для подтверждения.
                </p>

                <div class="mb-6">
                    <label for="password" class="block text-lg font-medium text-gray-700">Пароль</label>
                    <input id="password" name="password" type="password" placeholder="Пароль"
                           class="mt-1 block w-full p-2 border rounded-lg focus:ring-2 focus:ring-red-500" required>
                    @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="document.getElementById('confirm-deletion-modal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                        Отмена
                    </button>

                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                        Удалить аккаунт
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
