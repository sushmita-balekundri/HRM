<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Salary extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'basic_salary', 'total_working_days','present_days','lop_days','day_salary','month','year','emp_id','net_salary','tax','esi','pf','lop','deduction',
    ];
}
