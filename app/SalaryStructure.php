<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SalaryStructure extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'emp_id','name','designation','gross_salary', 'basic', 'hra','conveyance','esi','pf','spcl_allowance','performance_bonus','night_allowance','statutory_bonus',
    ];
}
