<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the AdminUserSeeder
        $this->call([
            AdminUserSeeder::class,
        ]);
        //         User::factory()->create([
        //     'name' => 'Omar',
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('admin123'),
        //     'role' => User::ROLE_ADMIN,
        // ]);
    }
}
