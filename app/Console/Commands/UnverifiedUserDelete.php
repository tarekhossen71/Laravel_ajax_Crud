<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UnverifiedUserDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unverified User Data Delete From Database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return User::whereNull('email_verified_at')->delete();
    }
}
