<?php
  
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\MasterAttendance;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
class MasterAttendanceController extends Controller
{
    public function __construct()
    { 
        $this->middleware('admin');
    }
	
	public function checkDate(Request $request)
	{
		$month_year = $request->input('month_year');
		$isExists = \App\MasterAttendance::where('month_year',$month_year)->first();
		if($isExists){
		        return response()->json(array("exists" => true));
		    }else{
		        return response()->json(array("exists" => false));
		}
	}

    public function index(){
        return view('admin.system-management.attendance.master-atten.index');
    }
    
	public function getUsers()
	{
        // Call getuserData() method of Page Model
        $userData['data'] = MasterAttendance::getuserData();
        echo json_encode($userData);
        exit;
    }
    
      // Insert record
	public function addUser(Request $request)
	{
        $month = $request->input('month');
        $year = $request->input('year');
        $month_year = $request->input('month_year');
        $total_days = $request->input('total_days');
        $working_days = $request->input('working_days');
        $attend_det = $request->input('attend_det');
        $emp_attendance = array();
        foreach($attend_det as $key => $val){
          $emp_attendance[$key+1] = $val; 
		}
		
       	$emp_attendance = json_encode($emp_attendance);
       	if($month !='' && $year !='' && $month_year != '' && $emp_attendance != ''&& $total_days != '' && $working_days != ''){
        	$data = array('month'=>$month,'year'=>$year,'month_year'=>$month_year,'emp_attendance'=>$emp_attendance,'total_days'=>$total_days,'working_days'=>$working_days,);
    		// Call insertData() method of Page Model
			$value = MasterAttendance::insertData($data);
			if($value)
		  	{
          		echo $value;
          	}else{
            	echo 0;
          	}
        }else{
           echo 'Fill all fields.';
        }
		echo json_encode($data);
        exit; 
    }
	

    // Update record
	public function updateUser(Request $request)
	{
        $month = $request->input('month');
        $year = $request->input('year');
        $month_year = $request->input('month_year');
        $editid = $request->input('editid');
        $attend_det = $request->input('attend_det');
        $emp_attendance = array();
        foreach($attend_det as $key => $val){
          $emp_attendance[$key+1] = $val; 
        }

       	$emp_attendance = json_encode($emp_attendance);
		if($month !='' && $year != '' && $month_year != '')
		{
        	$data = array('month'=>$month,"year"=>$year,'month_year'=>$month_year,'emp_attendance'=>$emp_attendance,);
        	// Call updateData() method of Page Model
        	MasterAttendance::updateData($editid, $data);
        	echo 'Update successfully.';
        	}else{
          	echo 'Fill all fields.';
        	}
        	exit; 
    	}
	}