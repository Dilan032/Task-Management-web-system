<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_name',
        'institute_type',
        'institute_address',
        'institute_contact_num',
        'email',
        'assigned_employee',
        'status',
    ];


    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}


