<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Enums\ReservationsStatus;
use App\Http\Requests\ReservationCreateRequest;
use App\Models\Book;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{



    public function store(ReservationCreateRequest $request)
    {
        $reservation = Reservation::where('book_id', $request->book_id)
            ->where('status', ReservationsStatus::BOOKED)
            ->where('booking_date', '>=', Carbon::now())
            ->exists();

        if ($reservation) {
            return redirect()->route('book.index')->withErrors(['message' => 'Эта книга уже забронирована']);
        } else {

            // Создание новой брони
            Reservation::create([
                'user_id'      => auth()->id(),
                'book_id'      => $request->book_id,
                'status'       => ReservationsStatus::BOOKED,
                'booking_date' => Carbon::now()->addDays(14),
            ]);

            // Перенаправление на список книг
            return redirect()->back();
        }
    }



    public function cancel(Book $book)
    {
        $reservation = Reservation::where('book_id', $book->id)
            ->where('status', ReservationsStatus::BOOKED)
            ->where('booking_date', '>=', Carbon::now())
            ->first();

        if ($reservation) {
            $reservation->update(['status' => ReservationsStatus::CANCELED, 'booking_date' => null]);

        }

        return redirect()->route('reservation.user.index');
    }

    public function userReservations()
    {
        // Получаем только бронирования текущего пользователя
        $reservations = Reservation::where('user_id', auth()->id())->get();

        return view('reservation.user.index', compact('reservations'));
    }

}
