<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Leave extends Authenticatable
{
    public $timestamps = true;
    protected $fillable = [
        'id', 'name', 'emp_id','date_from','date_to','days','reason','status','created_at','updated_at'
    ];
    
}
