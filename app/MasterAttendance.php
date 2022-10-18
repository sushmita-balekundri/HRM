<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MasterAttendance extends Authenticatable
{
    public $timestamps = true;
    // protected $fillable = [
    //     'id', 'month','year','month_year','total_days','working_days', 'emp_attendance','created_at','updated_at'
    // ];
    protected $casts = [
        'emp_attendance' => 'array',
    ];

	public static function getuserData($id=null)
	{
        $value=DB::table('master_attendances')->orderBy('id', 'asc')->get(); 
        return $value;
    }
   
	public static function insertData($data)
	{   
        $value=DB::table('master_attendances')->where('month_year', $data['month_year'])->get();
        if($value->count() == 0){
          $insertid = DB::table('master_attendances')->insertGetId($data);
          return $insertid;
        
        }else{
          return 0;
        }
    }
   
	public static function updateData($id,$data)
	{
        DB::table('master_attendances')->where('id', $id)->update($data);
    }
    
}
