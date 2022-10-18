<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Designation extends Authenticatable
{
    public $timestamps = true;
    protected $fillable = [
        'id', 'code', 'name','created_at','updated_at'
    ];
    
}
