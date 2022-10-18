<?php
  
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\Attendance;
use App\MasterAttendance;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
class AttendanceController extends Controller
{
    public function __construct()
    { 
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Attendance $attendance, Request $request)
    {
        $attendance = Attendance::where('emp_id', '!=', 'Admin')->latest()->paginate(70);
        return view('admin.system-management.attendance.index',compact('attendance'));
        
    }
   
    //  public function index(Attendance $attendance)
    //  {
    //     $attendance = Attendance::where('emp_id', '!=', 'Admin')->orderBy('emp_id', 'desc')->paginate(20);  
    //     return view('admin.system-management.attendance.index',compact('attendance'))
    //     ->with('i', (request()->input('page', 1) - 1) * 9);
    // }

    public function create()
    {
        $users = User::all()->where('emp_id', '!=', 'Admin');
        $attendance = MasterAttendance::all();
        $attend = Attendance::all();
        return view('admin.system-management.attendance.create',compact('users','attendance','attend'));
    }


    public function checkDate(Request $request){
        $month_year = $request->input('month_year');
        $isExists = \App\Attendance::where('month_year',$month_year)->first();
        if($isExists){
            return response()->json(array("exists" => true));
        }else{
            return response()->json(array("exists" => false));
        }
    }
    
    public function store(Request $request)
    {
        $month_year = Attendance::where('month_year',$request->month_year)->get();
        $d = implode($request->month_year, ' ');
        if(count($month_year))
        {
            return redirect()->route('attendance.create')
            ->with('success','Already Created Attendance for'.' "'. strtok($d, " ").'"');
        }

        $user = User::all()->where('emp_id', '!=', 'Admin');
        foreach($user as $key => $users)  { 
             DB::table('attendances')->insert([
                ['emp_id' => $request->emp_id[$key], 'name' => $request->name[$key], 'month' => $request->month[$key], 'year' => $request->year[$key], 'month_year' => $request->month_year[$key], 'present' => $request->present[$key],'absent' => $request->absent[$key],'total_days' => $request->total_days[$key],'working_days' => $request->working_days[$key],'emp_attendance' => json_encode($request->emp_attendance[$key]),],
            ]);
        }
        return redirect()->route('attendance.index')
            ->with('success','Attendance created successfully.');                
    }

    
    public function update1(Request $request)
    {
        $attendance = Attendance::all()->where('emp_id', '!=', 'Admin');
        $month_year = implode($request->month_year, ' ');
        $mmyy = strtok($month_year, " ");
   
        foreach($attendance as $key => $attendances)  {    
            if($attendances->month_year == $mmyy){
            $input = [
                'present' => $request->present[$key],
                'absent' => $request->absent[$key],
                'working_days' => $request->working_days[$key],
                'emp_attendance' => json_encode($request->emp_attendance[$key]),
            ];
            DB::table('attendances')->whereIn('id', [$attendances->id])->update($input);
            }
        }

        return redirect()->route('attendance.index')
                        ->with('success','Attendance Updated successfully.');
    }


    public function show(Attendance $attendance)
    {
        return view('admin.system-management.attendance.show',compact('attendance'));
    }
   
    public function search()
    { 
		$q = Input::get('q');
		if($q != ""){
		$user = Attendance::where('name', 'LIKE', '%' . $q . '%')->paginate(7)->setPath('');
		$pagination = $user->appends(array(
				'q' => Input::get ( 'q' ) 
		));
		if (count ( $user ) > 0)
		return view ('admin.system-management.attendance.index')->withDetails($user)->withQuery($q)->with('i',(request()->input('page', 1) - 1) * 5);
		}
		return view ('admin.system-management.attendance.index')->withMessages('No Details found. Try to search again !');
    }    
}