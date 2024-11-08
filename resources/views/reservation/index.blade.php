@php
    use App\Enums\ReservationsStatus;
    use Carbon\Carbon;
@endphp

@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <h2 class="text-center mb-4">Список забронированных книг</h2>

        <form method="GET" action="{{ route('reservations.index') }}" class="container my-5 p-4 bg-light rounded shadow-sm">
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <input type="text" class="form-control form-control-lg border-primary shadow-sm" id="search"
                           name="search" placeholder="🔍 Поиск по запросу" value="{{ request('search') }}">
                </div>

                <div class="col-md-6 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">Применить фильтр</button>
                    <a href="{{ route('reservations.index') }}" class="btn btn-outline-secondary btn-lg px-4 shadow-sm">Сбросить</a>
                </div>
            </div>
        </form>

        @if($reservations->isEmpty())
            <div class="alert alert-warning text-center">Нет активных бронирований.</div>
        @else
            <table class="table table-hover table-striped table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>Название книги</th>
                    <th>Пользователь</th>
                    <th>Дата бронирования</th>
                    <th>Дата окончания</th>
                    <th>Дней до конца бронирования</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->book->title }}</td>
                        <td>{{ $reservation->user->name }}</td>
                        <td>{{ $reservation->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->booking_date)->format('d.m.Y') }}</td>
                        <td>
                            {{ round(Carbon::now()->diffInDays(Carbon::parse($reservation->booking_date))) }} д
                        </td>
                        <td>
                            @if($reservation->status === ReservationsStatus::BOOKED)
                                <span class="badge bg-warning text-dark">Забронировано</span>
                            @elseif($reservation->status === ReservationsStatus::CONFIRMED)
                                <span class="badge bg-success">Подтверждено</span>
                            @elseif($reservation->status === ReservationsStatus::CANCELED)
                                <span class="badge bg-danger">Отменено</span>
                            @elseif($reservation->status === ReservationsStatus::GIVEN)
                                <span class="badge bg-primary">Выдано</span>
                            @endif
                        </td>
                        <td>
                            @if($reservation->status === ReservationsStatus::BOOKED)
                                <form action="{{ route('reservations.confirm', $reservation->book->id) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Подтвердить</button>
                                </form>
                            @endif
                            @if($reservation->status === ReservationsStatus::CONFIRMED)
                                <form action="{{ route('reservations.given', $reservation->book->id) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Выдать</button>
                                </form>
                            @endif
                            <form action="{{ route('reservations.cancel', $reservation->book->id) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Отменить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
