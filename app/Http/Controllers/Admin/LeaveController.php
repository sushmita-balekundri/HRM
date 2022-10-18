<?php
  
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input; 

class LeaveController extends Controller
{
    public function __construct()
    { 
        $this->middleware('admin');
    }
    
    public function index()
    {
        $leave = Leave::latest()->paginate(7);
        return view('admin.leave-management.index',compact('leave'))
            ->with('i', (request()->input('page', 1) - 1) * 7);
    }
   
    public function update(Request $request, Leave $leave)
    {
        $request->validate([
            'emp_id' => 'string',
            'name' => 'string',
        ]);
        
        $leave->update($request->all());
        
        return redirect()->back()->with('success','Updated Successfully.');
    }
    
    // public function reject()
    // {
    //     $leave = Leave::latest()->paginate(7);
    //     return view('admin.leave-management.index',compact('leave'))
    //         ->with('i', (request()->input('page', 1) - 1) * 5);
    // }

    public function search()
    { 
		$q = Input::get('q');
		if($q != ""){
		$user = Leave::where('name', 'LIKE', '%' . $q . '%')->latest()->paginate(7)->setPath('');
		$pagination = $user->appends(array(
				'q' => Input::get ( 'q' ) 
		));
		if (count ( $user ) > 0)
		return view ('admin.leave-management.index')->withDetails($user)->withQuery($q)->with('i',(request()->input('page', 1) - 1) * 5);
		}
		return view ('admin.leave-management.index')->withMessages('No Details found. Try to search again !');
	} 
}