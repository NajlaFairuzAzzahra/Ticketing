<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class, // Jalankan RoleSeeder lebih dulu
            UserSeeder::class, // Kemudian jalankan UserSeeder
        ]);
    }
}
