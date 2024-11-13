{{--@php--}}
{{--use Illuminate\Support\Carbon;--}}
{{--use App\Enums\ReservationsStatus--}}
{{-- @endphp--}}

{{--<!DOCTYPE html>--}}
{{--<html lang="ru">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Список бронирований</title>--}}
{{--    @vite('resources/css/app.css')--}}
{{--    <link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">--}}
{{--</head>--}}
{{--<body class="bg-gray-100 text-gray-900">--}}

{{--<!-- Header -->--}}
{{--<header class="w-full bg-white shadow">--}}
{{--    <div class="border-b-2 border-green-600 px-8 py-4 flex justify-between items-center container mx-auto">--}}
{{--        <div>--}}
{{--            @include('components/nav-menu') <!-- Навигационное меню -->--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</header>--}}

{{--<!-- Main Content -->--}}
{{--<main class="container mx-auto my-8 p-8 bg-white rounded-lg shadow-md">--}}
{{--    <!-- Title -->--}}
{{--    <h1 class="text-3xl font-semibold text-center mb-8">Список забронированных книг</h1>--}}

{{--    <!-- Форма поиска -->--}}
{{--    <div class="mb-8">--}}
{{--        <h2 class="text-xl font-bold text-green-700 mb-4">Поиск бронирований</h2>--}}
{{--        <form action="{{ route('reservations.index') }}" method="get" class="flex items-center space-x-4">--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                name="search"--}}
{{--                class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:border-green-500"--}}
{{--                placeholder="Введите название книги или имя пользователя"--}}
{{--                value="{{ request()->get('search') }}">--}}
{{--            <button--}}
{{--                type="submit"--}}
{{--                class="bg-green-500 text-white px-4 py-2 rounded-r-lg hover:bg-green-600 transition">--}}
{{--                Поиск--}}
{{--            </button>--}}
{{--            @if(request()->has('search'))--}}
{{--                <form action="{{ route('reservations.index') }}" method="get">--}}
{{--                    <button--}}
{{--                        type="submit"--}}
{{--                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition">--}}
{{--                        Сбросить--}}
{{--                    </button>--}}
{{--                </form>--}}
{{--            @endif--}}
{{--        </form>--}}
{{--    </div>--}}

{{--    <!-- Список забронированных книг -->--}}
{{--    @if($reservations->isEmpty())--}}
{{--        <div class="alert alert-warning text-center">Нет активных бронирований.</div>--}}
{{--    @else--}}
{{--        <div class="overflow-x-auto bg-gray-50 p-6 rounded-lg shadow-md">--}}
{{--            <table class="min-w-full table-auto border-collapse border border-gray-300">--}}
{{--                <thead class="bg-gray-200">--}}
{{--                <tr>--}}
{{--                    <th class="border px-4 py-2 text-left font-semibold">Название книги</th>--}}
{{--                    <th class="border px-4 py-2 text-left font-semibold">Пользователь</th>--}}
{{--                    <th class="border px-4 py-2 text-left font-semibold">Дата бронирования</th>--}}
{{--                    <th class="border px-4 py-2 text-left font-semibold">Дата окончания</th>--}}
{{--                    <th class="border px-4 py-2 text-left font-semibold">Дней до конца бронирования</th>--}}
{{--                    <th class="border px-4 py-2 text-left font-semibold">Статус</th>--}}
{{--                    <th class="border px-4 py-2 text-left font-semibold">Действия</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($reservations as $reservation)--}}
{{--                    <tr class="border-b">--}}
{{--                        <td class="border px-4 py-2">{{ $reservation->book->title }}</td>--}}
{{--                        <td class="border px-4 py-2">{{ $reservation->user->name }}</td>--}}
{{--                        <td class="border px-4 py-2">{{ $reservation->created_at->format('d.m.Y H:i') }}</td>--}}
{{--                        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($reservation->booking_date)->format('d.m.Y') }}</td>--}}
{{--                        <td class="border px-4 py-2">--}}
{{--                            {{ round(Carbon::now()->diffInDays(Carbon::parse($reservation->booking_date))) }} д--}}
{{--                        </td>--}}
{{--                        <td class="border px-4 py-2">--}}
{{--                            @if($reservation->status === ReservationsStatus::BOOKED)--}}
{{--                                <span class="bg-yellow-300 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">Забронировано</span>--}}
{{--                            @elseif($reservation->status === ReservationsStatus::CONFIRMED)--}}
{{--                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Подтверждено</span>--}}
{{--                            @elseif($reservation->status === ReservationsStatus::CANCELED)--}}
{{--                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Отменено</span>--}}
{{--                            @elseif($reservation->status === ReservationsStatus::GIVEN)--}}
{{--                                <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Выдано</span>--}}
{{--                            @endif--}}
{{--                        </td>--}}

{{--                        <td class="border px-4 py-2">--}}
{{--                            <div class="flex space-x-2">--}}
{{--                                <!-- Кнопка "Подтвердить" -->--}}
{{--                                @if($reservation->status === ReservationsStatus::BOOKED)--}}
{{--                                    <form action="{{ route('reservations.confirm', $reservation->book->id) }}" method="post" class="d-inline">--}}
{{--                                        @csrf--}}
{{--                                        <button type="submit" class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600 transition duration-300">Подтвердить</button>--}}
{{--                                    </form>--}}
{{--                                @endif--}}

{{--                                <!-- Кнопка "Выдать" -->--}}
{{--                                @if($reservation->status === ReservationsStatus::CONFIRMED)--}}
{{--                                    <form action="{{ route('reservations.given', $reservation->book->id) }}" method="post" class="d-inline">--}}
{{--                                        @csrf--}}
{{--                                        <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition duration-300">Выдать</button>--}}
{{--                                    </form>--}}
{{--                                @endif--}}

{{--                                <!-- Кнопка "Отменить" (всегда доступна) -->--}}
{{--                                <form action="{{ route('reservations.cancel', $reservation->book->id) }}" method="post" class="d-inline">--}}
{{--                                    @csrf--}}
{{--                                    <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600 transition duration-300">Отменить</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </td>--}}


{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    @endif--}}
{{--</main>--}}

{{--</body>--}}
{{--</html>--}}
