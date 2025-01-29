<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'Software'],
            ['id' => 2, 'name' => 'Hardware'],
            ['id' => 3, 'name' => 'Network'],
            ['id' => 4, 'name' => 'Email'],
            ['id' => 5, 'name' => 'Others'],
        ];

        foreach ($categories as $category) {
            Category::updateOrInsert(['id' => $category['id']], $category);
        }
    }
}
