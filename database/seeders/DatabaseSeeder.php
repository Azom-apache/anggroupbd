<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HigherOrderTapProxy;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $user = tap(
            User::create([
                'id' => 1,
                'name' => 'User',
                'phone' => '01700000000',
                'email' => 'user@gmail.com',
                'password' => Hash::make('123456789')
            ])
        )->markEmailAsVerified();

        $admin = Admin::create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '01889173335',
            'password' => Hash::make('123456789')
        ]);

        $this->call(LaratrustSeeder::class);

        $user->addRole(Role::whereName('user')->first());
        $admin->addRole(Role::whereName('admin')->first());
    }
}
