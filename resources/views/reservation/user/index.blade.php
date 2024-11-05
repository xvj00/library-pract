<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Мои бронирования') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold">{{ __("Ваши текущие бронирования") }}</h3>

                    <table class="min-w-full table-auto mt-4">
                        <thead>
                        <tr>
                            <th>Книга</th>
                            <th>Дата бронирования</th>
                            <th>Период</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->book->title }}</td>
                                <td>{{ $reservation->created_at }}</td>
                                <td>{{ $reservation->booking_date }}</td>
                                <td>{{ $reservation->status }}</td>
                                <td>
                                    @if($reservation->status === 'booked')
                                        <form action="{{ route('reservations.cancel', $reservation->book->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Отменить</button>
                                        </form>
                                    @elseif($reservation->status === 'confirmed')
                                        <button class="btn btn-secondary" disabled>Подтверждено</button>
                                    @else
                                        <button class="btn btn-secondary" disabled>Отменено</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
