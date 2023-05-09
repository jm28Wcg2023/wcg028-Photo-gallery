<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {email} {password} {phone}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the Command to Create the Admin admin:create {email} {password} {phone} is like ex.  php artisan admin:create admin@example.com password123 +917990458918';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $phone = $this->argument('phone');

        $user = new User();
        $user->name = 'Admin';
        $user->email = $email;
        $user->phone = $phone;
        $user->password = Hash::make($password);
        $user->role = '1';
        $user->affiliation_link = null;
        $user->save();

        $this->info("Admin user created with email: $email");
    }
}
