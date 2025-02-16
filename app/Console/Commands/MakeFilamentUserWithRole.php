<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Console\Command;

class MakeFilamentUserWithRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-filament-user-with-role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Filament User and assign Role';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('name');
        $email = $this->ask('email');
        $password = $this->ask('password');

        $roles = Role::pluck('slug')->toArray();

        if(empty($roles)){
            $this->error('No role available. make sure you have roles');
            return;
        }

        $role = $this->choice('choose user\'s role', $roles, 0);

        $user = User::create([
            'name' => $name,
            'email' => $email, 
            'password' => bcrypt($password),
            'role_slug' => $role
        ]);

        Filament::auth()->login($user);

        $this->info("User {$name} has been created with role as {$role}");
    }
}
