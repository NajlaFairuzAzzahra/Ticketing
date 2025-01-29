<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'assigned_to', 'system', 'sub_system', 'wo_type',
        'scope', 'description', 'request_date', 'organization', 'requester', 'status'
    ];

    protected $casts = [
        'status' => 'string', // Laravel akan membaca ENUM sebagai string
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function setStatusAttribute($value)
    {
    $allowedStatuses = ['Open', 'In Progress', 'Closed'];
    $this->attributes['status'] = in_array($value, $allowedStatuses) ? $value : 'Open';
    }

    public function assignedStaff()
    {
    return $this->belongsTo(User::class, 'assigned_to');
    }

}
