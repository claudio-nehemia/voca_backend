<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sarah Anderson (The mock user from screenshot)
        User::create([
            'name' => 'Sarah Anderson',
            'email' => 'sarah@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'is_active' => true,
            'score' => 2450,
            'class' => '10-A',
        ]);

        // Top Students for leaderboard (also from screenshots)
        User::create([
            'name' => 'Michael Chen',
            'email' => 'michael@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'is_active' => true,
            'score' => 3200,
            'class' => '10-B',
        ]);

        User::create([
            'name' => 'Emma Wilson',
            'email' => 'emma@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'is_active' => true,
            'score' => 2980,
            'class' => '10-A',
        ]);

        User::create([
            'name' => 'James Brown',
            'email' => 'james@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'is_active' => true,
            'score' => 2750,
            'class' => '10-C',
        ]);

        // Add some more users
        User::factory(10)->create([
            'role' => 'user',
            'is_active' => true,
        ]);
    }
}
