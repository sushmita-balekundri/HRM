<?php
  
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\User;
use App\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input; 

class UsermanagementController extends Controller
{
    public function __construct()
    { 
        $this->middleware('admin');
    }
    
    public function index()
    {
        $employee = User::where('role', 'Employee')->get();
        return view('admin.user-management.index',compact('employee'))
            ->with('i');
    }
   
    public function create()
    {
        $designation = Designation::all();
        return view('admin.user-management.create',compact('designation'));
    }
  
    public function checkEmail(Request $request){
        $email = $request->input('email');
        $isExists = \App\User::where('email',$email)->first();
        if($isExists){
            return response()->json(array("exists" => true));
        }else{
            return response()->json(array("exists" => false));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'emp_id' => 'required',
            'emp_grade' => 'required',
            'designation' => 'required',
            'doj' => 'required',
            'dob' => 'required',
            'blood_group' => 'required',
            'education' => 'required',
            'address' => 'required',
            'account' => 'required',
            'bank_name' => 'required',
            'aadhar_no' => 'required',
            'pan_no' => 'required',
            'personal_no' => 'required',
            'emergency_no' => 'required',
            'basic_salary' => 'required',
            'pf_no' => 'required',
            'uan' => 'required',
            'user_status' => 'required',
            'join_letter' => 'required',
            'exp_letter' => 'required',
            'payslip' => 'required',
            'password' => 'required',
        ]);
        
        $request['basic_salary'] = str_replace(',', '', $request['basic_salary']);
        $request['password'] = bcrypt($request['password']);
        $data = User::create($request->all());
    
        return redirect()->route('employee.index')
                        ->with('success','Employee Added Successfully.');
    }
   
    public function show(User $employee)
    {
        return view('admin.user-management.show',compact('employee'));
    }
   
    public function edit(User $employee)
    {
        $designation = Designation::all();
        return view('admin.user-management.edit',compact('employee','designation'));
    }
  
    public function update(Request $request, User $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'emp_id' => 'required',
            'emp_grade' => 'required',
            'designation' => 'required',
            'doj' => 'required',
            'dob' => 'required',
            'blood_group' => 'required',
            'education' => 'required',
            'address' => 'required',
            'account' => 'required',
            'bank_name' => 'required',
            'aadhar_no' => 'required',
            'pan_no' => 'required',
            'personal_no' => 'required',
            'emergency_no' => 'required',
            'basic_salary' => 'required',
            'pf_no' => 'required',
            'uan' => 'required',
            'user_status' => 'required',
            'join_letter' => 'required',
            'exp_letter' => 'required',
            'payslip' => 'required',
            // 'password' => 'required',
        ]);
        $request['basic_salary'] = str_replace(',', '', $request['basic_salary']);
        // $request['password'] = bcrypt($request['password']);
        $data = $employee->update($request->all());
  
        return redirect()->route('employee.index')
            ->with('success','Employee updated successfully');
    }
  
    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')
            ->with('success','Employee deleted successfully');
    }

    public function search()
    { 
		$q = Input::get('q');
		if($q != ""){
		$user = User::where('name', 'LIKE', '%' . $q . '%')->paginate(7)->setPath('');
		$pagination = $user->appends(array(
				'q' => Input::get ( 'q' ) 
		));
		if (count ( $user ) > 0)
		return view ('admin.user-management.index')->withDetails($user)->withQuery($q)->with('i',(request()->input('page', 1) - 1) * 5);
		}
		return view ('admin.user-management.index')->withMessages('No Details found. Try to search again !');
    } 
    
}