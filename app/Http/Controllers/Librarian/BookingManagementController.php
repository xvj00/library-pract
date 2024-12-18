<?php

namespace App\Http\Controllers\Librarian;

use App\Enums\ReservationsStatus;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingManagementController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::query();

        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';

            $reservations->where(function($query) use ($searchTerm) {
                $query->orWhere('status', 'ilike', $searchTerm)
                    ->orWhereHas('book', function ($query) use ($searchTerm) {
                    $query->where('title', 'ilike', $searchTerm);
                    })
                    ->orWhereHas('user', function ($query) use ($searchTerm) {
                        $query->where('name', 'ilike', $searchTerm);
                    });
            });
        }

        $reservations = $reservations->get();


        return view('pages.library-man.library_control', compact('reservations'));

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
            ->where('status', ReservationsStatus::BOOKED)->orWhere('status', ReservationsStatus::CONFIRMED)
            ->where('booking_date', '>=', Carbon::now())
            ->first();

        if ($reservation) {
            $reservation->update(['status' => ReservationsStatus::CANCELED, 'booking_date' => null]);

        }

        return redirect()->route('reservations.index');
    }

    public function given(Book $book)
    {
        $reservation = Reservation::where('book_id', $book->id)
            ->where('status', ReservationsStatus::CONFIRMED)
            ->first();

        if ($reservation) {
            $reservation->update(['status' => ReservationsStatus::GIVEN, 'booking_date' => null]);

        }

        return redirect()->route('reservations.index');
    }
}
