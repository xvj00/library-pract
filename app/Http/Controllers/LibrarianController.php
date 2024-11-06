<?php

namespace App\Http\Controllers;

use App\Enums\ReservationsStatus;
use App\Models\Book;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LibrarianController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservation.index', compact('reservations'));

    }

    public function confirm(Book $book)
    {
        $reservation = Reservation::where('book_id', $book->id)
            ->where('status', ReservationsStatus::BOOKED)
            ->where('booking_date', '>=', Carbon::now())
            ->first();

        if ($reservation) {
            $reservation->update(['status' => ReservationsStatus::CONFIRMED, 'booking_date' => null]);

        }

        return redirect()->route('reservations.index');
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

        return redirect()->route('reservations.index');
    }
}
