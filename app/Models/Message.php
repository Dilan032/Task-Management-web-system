<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'assigned_user_id',
        'institute_id',
        'subject',
        'message',
        'status',
        'request',
        'img_1',
        'img_2',
        'img_3',
        'img_4',
        'img_5',
        'start_time',
        'end_time',
        'progress_note',
    ];



    public function user() {
        return $this->belongsTo(User::class);
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }
}
