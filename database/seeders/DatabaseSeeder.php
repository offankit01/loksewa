<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User (uses firstOrCreate so it's safe to run multiple times)
        User::firstOrCreate(
            ['email' => 'admin@loksewa.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        // Standard Test User
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );
    }
}
