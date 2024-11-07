<?php

use App\Console\Commands\DevCom;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();



\Illuminate\Support\Facades\Schedule::command(DevCom::class)->everyFiveSeconds();
