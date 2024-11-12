<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление пользователями</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
</head>
<body id="app" class="bg-gray-100 text-gray-900 ">
<!-- Header -->
<header class="w-full bg-white shadow">
    <div class="border-b-2 border-green px-8 py-4 flex justify-between items-center  container mx-auto ">
        <div>
            @include('components/nav-menu')
        </div>
    </div>
</header>

<!-- Main Image Component -->
{{--@include('components/main_img')--}}

<!-- Main Content -->
<main class="main container mx-auto my-8 p-8 bg-white rounded-lg shadow-md">
    <!-- Title -->
    <h1 class="text-3xl font-semibold text-center mb-8">Управление пользователями</h1>

    <h2 class="text-xl font-bold mb-4 text-green-700">Поиск пользователя</h2>
    <div class="flex items-center space-x-4 mb-4">
        <!-- Search Form -->
        <form action="{{ route('admin.index') }}" method="get" class="flex items-center w-full">
            <input
                type="text"
                name="search"
                class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:border-green-500"
                placeholder="Введите имя или email"
                value="{{ request()->get('search') }}">
            <button
                type="submit"
                class="bg-green-500 text-white px-4 py-2 rounded-r-lg hover:bg-green-600 transition">
                Поиск
            </button>
        </form>
        <!-- Reset Button -->
        @if(request()->has('search'))
        <form action="{{ route('admin.index') }}" method="get">
            <button
                type="submit"
                class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition">
                Сбросить
            </button>
        </form>
        @endif
    </div>



    <!-- Add User Form -->
    <section class="mb-12">
        <h2 class="text-xl font-bold mb-4 text-green-700">Добавление пользователя</h2>
        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
            <form action="{{ route('admin.store') }}" method="post">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Имя</label>
                        <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" placeholder="Введите имя" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" placeholder="name@example.com" value="{{ old('email') }}">
                        @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
                        <input type="password" id="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="mt-6 text-center">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600">Отправить</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Active Users Table -->
    <section class="mb-12">
        <h2 class="text-xl font-bold mb-4 text-green-700">Список пользователей</h2>
        <div class="overflow-x-auto bg-gray-50 p-6 rounded-lg shadow-md">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2 text-left font-semibold">ID</th>
                    <th class="border px-4 py-2 text-left font-semibold">Имя</th>
                    <th class="border px-4 py-2 text-left font-semibold">Email</th>
                    <th class="border px-4 py-2 text-left font-semibold">Роль</th>
                    <th class="border px-4 py-2 text-left font-semibold">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    @if($user->deleted_at == null)
                        <tr class="border-b">
                            <td class="border px-4 py-2">{{ $user->id }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ $user->role }}</td>
                            <td class="border px-4 py-2">
                                <div class="flex space-x-2">
                                    <form action="{{ route('admin.destroy', $user->id) }}" method="post" class="mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Удалить</button>
                                    </form>
                                    <a href="{{ route('admin.edit', $user->id) }}" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Обновить</a>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <div class="mt-4">
        {{ $users->links('pagination::tailwind') }}
    </div>
    <!-- Deleted Users Table -->
    <section>
        <h2 class="text-xl font-bold mb-4 text-red-700">Удаленные пользователи</h2>
        <div class="overflow-x-auto bg-gray-50 p-6 rounded-lg shadow-md">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2 text-left font-semibold">ID</th>
                    <th class="border px-4 py-2 text-left font-semibold">Имя</th>
                    <th class="border px-4 py-2 text-left font-semibold">Email</th>
                    <th class="border px-4 py-2 text-left font-semibold">Роль</th>
                    <th class="border px-4 py-2 text-left font-semibold">Восстановить</th>
                    <th class="border px-4 py-2 text-left font-semibold">Удалить навсегда</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    @if($user->deleted_at !== null)
                        <tr class="border-b">
                            <td class="border px-4 py-2">{{ $user->id }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ $user->role }}</td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('admin.restore', $user->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Восстановить</button>
                                </form>
                            </td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('admin.forceDelete', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Удалить навсегда</button>
                                </form>
                            </td>
                        </tr>
                    @endif

                @endforeach
                </tbody>

            </table>
        </div>
    </section>
</main>

<!-- Footer -->
{{--@include('components/footer')--}}
</body>
</html>
