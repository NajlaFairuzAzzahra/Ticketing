<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'assigned_to', 'system', 'sub_system', 'wo_type',
        'scope', 'description', 'request_date', 'organization', 'requester',
        'status', 'attachment', 'link'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignedStaff()
    {
        return $this->belongsTo(User::class, 'assigned_to')->withDefault([
            'name' => 'Not Assigned'
        ]);
    }

    // 🔥 **Tambahkan relasi comments di sini!**
    public function comments()
    {
        return $this->hasMany(Comment::class, 'ticket_id', 'id');
    }
}
