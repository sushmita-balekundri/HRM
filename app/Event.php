<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Event extends Authenticatable
{
    public $timestamps = true;
    protected $fillable = [
        'id', 'event_name', 'start_date','end_date','created_at','updated_at'
    ];
    
}