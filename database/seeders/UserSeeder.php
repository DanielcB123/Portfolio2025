<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Demo User 1',
            'email' => 'demo1@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Demo User 2',
            'email' => 'demo2@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
