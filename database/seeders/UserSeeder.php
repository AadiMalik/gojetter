<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Optional: clear existing users
        User::truncate();

        // Create Admin user
        $admin = User::create([
            'username' => 'super',
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'), // Change this in production!
        ]);
        $admin->assignRole('super admin');

        // Create Normal user
        $user = User::create([
            'username' => 'user',
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole('user');
    }
}
