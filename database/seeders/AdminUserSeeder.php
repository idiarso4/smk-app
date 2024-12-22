<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'superadmin',
            'email' => 'idiarsosimbang@gmail.com',
            'password' => Hash::make('password'),
            'user_type' => 'admin',
            'is_active' => true,
        ]);
    }
} 