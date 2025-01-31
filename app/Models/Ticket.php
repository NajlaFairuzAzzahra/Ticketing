<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'assigned_to', 'system', 'sub_system', 'wo_type',
        'scope', 'description', 'request_date', 'organization', 'requester',
        'status', 'attachment', 'link'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    protected $dates = ['deleted_at'];

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
