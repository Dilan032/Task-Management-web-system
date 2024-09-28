<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id', //Foreign key
        'assigned_employee_id',
        'assigned_employee',
        'institute_id', //Foreign key
        'subject',
        'message',
        'priority',
        'status',
        'request',
        'sp_request',
        'img_1',
        'img_2',
        'img_3',
        'img_4',
        'img_5',
        'start_time',
        'end_time',
        'progress_note',
        'viewed_at',
        'support_description',
        'support_img_1',
        'support_img_2',
        'support_img_3',
        'support_img_4',
        'support_img_5'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

}
