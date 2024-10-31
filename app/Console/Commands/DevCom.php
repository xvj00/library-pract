<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
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
        $user = User::find(2);

        $user -> delete();

        dd($user);

    }
}
