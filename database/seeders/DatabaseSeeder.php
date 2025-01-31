<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Comment;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class, // Jalankan RoleSeeder lebih dulu
            UserSeeder::class, // Kemudian jalankan UserSeeder
        ]);

        $ticket = Ticket::first(); // Ambil satu tiket

        if ($ticket) {
            Comment::create([
                'ticket_id' => $ticket->id,
                'user_id' => User::where('role_id', 2)->first()->id, // Ambil IT Staff pertama
                'content' => 'Ini adalah komentar uji coba pada tiket pertama.'
            ]);
        }

    }
}
