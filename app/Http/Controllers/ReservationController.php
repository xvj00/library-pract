<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Enums\ReservationsStatus;
use App\Http\Requests\ReservationCreateRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(ReservationCreateRequest $request){
        // Проверка, забронирована ли книга
        $review = Reservation::where('book_id', $request->book_id)
            ->where('status', ReservationsStatus::BOOKED)
            ->exists();

        if ($review) {
            // Если книга уже забронирована, вернуть с ошибкой
            abort(403,'Книга забронена');
        }

        // Создание новой брони
        Reservation::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'status' => ReservationsStatus::BOOKED,
        ]);

        // Перенаправление на список книг
        return redirect()->route('book.index');
    }
}
