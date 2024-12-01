<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
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
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Меню</h2>
            <ul class="space-y-3 text-gray-700">
                <li><a href="{{ route('profile.edit') }}" class="hover:text-green-500">Профиль</a></li>
                <li><a href="{{ route('book.catalog') }}" class="hover:text-green-500">Каталог книг</a></li>
            </ul>
        </aside>

        <!-- Основной контент -->
        <section class="col-span-2 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Ваши бронирования</h2>

            <!-- Таблица бронирований -->
            <div class="overflow-x-auto bg-gray-50 shadow rounded-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-green-100 text-green-900">
                    <tr>
                        <th class="p-4 text-left font-medium">Книга</th>
                        <th class="p-4 text-left font-medium">Дата бронирования</th>
                        <th class="p-4 text-left font-medium">Период</th>
                        <th class="p-4 text-left font-medium">Статус</th>
                        <th class="p-4 text-left font-medium">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reservations as $reservation)
                        <tr class="bg-white border-b hover:bg-gray-100">
                            <td class="p-4 text-gray-800">{{ $reservation->book->title }}</td>
                            <td class="p-4 text-gray-700">{{ \Carbon\Carbon::parse($reservation->created_at)->format('d.m.Y') }}</td>
                            <td class="p-4 text-gray-700">{{ \Carbon\Carbon::parse($reservation->booking_date)->format('d.m.Y') }}</td>
                            <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-white
                            {{ $reservation->status === 'booked' ? 'bg-green-500' :
                               ($reservation->status === 'confirmed' ? 'bg-blue-500' :
                               ($reservation->status === 'given' ? 'bg-yellow-500' : 'bg-red-500')) }}">
                            @if($reservation->status === 'booked')
                                Забронировано
                            @elseif($reservation->status === 'confirmed')
                                Подтверждено
                            @elseif($reservation->status === 'given')
                                Выдано
                            @else
                                Отменено
                            @endif
                        </span>
                            </td>
                            <td class="p-4">
                                @if($reservation->status === 'booked')
                                    <form action="{{ route('reservation.user.cancel', $reservation->book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition duration-200">
                                            Отменить
                                        </button>
                                    </form>
                                @else
                                    <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded-full cursor-not-allowed" disabled>
                                        {{ $reservation->status === 'confirmed' ? 'Подтверждено' : ($reservation->status === 'given' ? 'Выдано' : 'Отменено') }}
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </section>
    </div>
</main>

@vite('resources/js/app.js')
</body>
</html>
