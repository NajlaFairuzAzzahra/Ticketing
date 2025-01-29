<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            ['name' => 'IT Support'],
            ['name' => 'HR'],
            ['name' => 'Finance'],
        ]);
    }
}
