@php
    use App\Enums\ReservationsStatus;
    use Carbon\Carbon
@endphp

@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <h2>Список забронированных книг</h2>

        <form method="GET" action="{{ route('reservations.index') }}" class="container my-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="search" name="search"
                           placeholder="Поиск" value="{{ request('search') }}">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary ">Применить фильтр</button>
                    <a href="{{ route('reservations.index') }}" class="btn btn-secondary ms-2">Сбросить фильтр</a>
                </div>
            </div>
        </form>
        @if($reservations->isEmpty())
            <p>Нет активных бронирований.</p>
        @else
            <table class="table table-striped">
                <thead>
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
                        <td>{{$reservation->created_at}}</td>
                        <td>{{ $reservation->booking_date }}</td>
                        <td>{{ round(Carbon::now()->diffInDays(Carbon::parse($reservation->booking_date))) }} д</td>


                        <td>
                            @if($reservation->status ===  ReservationsStatus::BOOKED)
                                <span class="badge bg-warning text-dark">Забронировано</span>
                            @elseif($reservation->status ===  ReservationsStatus::CONFIRMED)
                                <span class="badge bg-success">Подтверждено</span>
                            @elseif($reservation->status === ReservationsStatus::CANCELED)
                                <span class="badge bg-danger">Отменено</span>
                            @endif
                        </td>
                        <td>
                            @if($reservation->status === ReservationsStatus::BOOKED)
                                <form action="{{ route('reservations.confirm', $reservation->book->id) }}" method="post"
                                      class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Подтвердить</button>
                                </form>
                            @endif
                            <form action="{{ route('reservations.cancel', $reservation->book->id) }}" method="post"
                                  class="d-inline">
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
