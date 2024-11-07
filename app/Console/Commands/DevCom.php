<?php

namespace App\Console\Commands;

use App\Enums\ReservationsStatus;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DevCom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Reservation::where('status', ReservationsStatus::BOOKED)
            ->where('booking_date', '<', Carbon::now())
            ->update(['status' => ReservationsStatus::CANCELED]);


        echo 'Очистка брони';
    }
}
