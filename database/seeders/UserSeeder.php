<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@example.com'], // ✅ Cek apakah email sudah ada
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Staff User',
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
