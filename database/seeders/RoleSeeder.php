<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::updateOrInsert(['id' => 1], ['name' => 'Admin']);
        Role::updateOrInsert(['id' => 2], ['name' => 'Staff']);
        Role::updateOrInsert(['id' => 3], ['name' => 'User']);
    }
}
