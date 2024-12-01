<section class="space-y-6 p-6 bg-white shadow-lg rounded-lg border border-gray-200">
    <header>
        <h2 class="text-2xl font-semibold text-gray-800">
            Информация профиля
        </h2>

        <p class="mt-2 text-base text-gray-600">
            Обновите информацию профиля и адрес электронной почты.
        </p>
    </header>

    <!-- Форма для отправки запроса на повторную верификацию email -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Форма обновления профиля -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-lg font-medium text-gray-700">Имя</label>
            <input id="name" name="name" type="text" class="mt-1 block w-full p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"
                   value="{{ old('name', auth()->user()->name) }}" required autofocus autocomplete="name">
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" class="mt-1 block w-full p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"
                   value="{{ old('email', auth()->user()->email) }}" required autocomplete="username">
            @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div class="mt-4 text-sm text-gray-800">
                    Ваш адрес электронной почты не подтвержден.

                    <button form="send-verification" class="underline text-indigo-600 hover:text-indigo-800">
                        Нажмите здесь, чтобы повторно отправить письмо для подтверждения.
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-green-600">
                            Новая ссылка для подтверждения отправлена на ваш email.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                Сохранить
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-gray-600">
                    Изменения сохранены.
                </p>
            @endif
        </div>
    </form>
</section>
