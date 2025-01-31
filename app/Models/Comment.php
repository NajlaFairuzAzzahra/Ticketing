<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_id', 'user_id', 'content'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

        // 🔹 Relasi untuk komentar utama
        public function parent()
        {
            return $this->belongsTo(Comment::class, 'parent_id');
        }

        // 🔹 Relasi untuk balasan komentar
        public function replies()
        {
            return $this->hasMany(Comment::class, 'parent_id');
        }

}
