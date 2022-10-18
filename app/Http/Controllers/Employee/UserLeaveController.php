<?php
  
namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller; 
use App\Leave;
use Illuminate\Http\Request;
  
class UserLeaveController extends Controller
{
    public function __construct()
    { 
        $this->middleware('employee');
    }
    
    public function index()
    {
        $userleave = Leave::all();
        return view('employee.leave-management.index',compact('userleave'));
    }
   
    public function create()
    {
        return view('employee.leave-management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'days' => 'required',
        ]);
    
        Leave::create($request->all());
        return redirect()->route('userleave.index')
            ->with('success','Leave application sent successfully');
    }

    public function update(Request $request, Leave $userleave)
    {
        $request->validate([
            'emp_id' => 'string',
            'name' => 'string',
        ]);
        
        $userleave->update($request->all());
        
        return redirect()->back()->with('success','Updated Successfully.');
    }
  
}