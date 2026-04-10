<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if it doesn't exist
        User::updateOrCreate(
            ['email' => 'admin@burgerzone.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'), // Change this in production!
                'role' => User::ROLE_ADMIN,
                'email_verified_at' => now(),
            ]
        );

        // Create test user
        User::updateOrCreate(
            ['email' => 'user@burgerzone.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('user123'), // Change this in production!
                'role' => User::ROLE_USER,
                'email_verified_at' => now(),
            ]
        );
    }
}

