<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'subject',
        'message',
        'status',
        'time_frame',
        'request',
        'img_1',
        'img_2',
        'img_3',
        'img_4',
        'img_5',
        'user_responded',
        'user_id',    //Foreign key
        'institute_id',    //Foreign key
    ];



    public function user() {
        return $this->belongsTo(User::class);
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }

}
