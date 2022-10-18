<?php
  
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input; 
  
class SystemroleController extends Controller
{
    public function __construct()
    { 
        $this->middleware('admin');
    }
    
    public function index()
    {
        $designation = Designation::latest()->paginate(7);
        return view('admin.system-management.designation.index',compact('designation'))
            ->with('i', (request()->input('page', 1) - 1) * 7);
    }
   
    public function create()
    {
        return view('admin.system-management.designation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);
        
        Designation::create($request->all());

        return redirect()->route('designation.index')
            ->with('success','Designation created successfully.');
    }

    public function show(Designation $designation)
    {
        return view('admin.system-management.designation.show',compact('designation'));
    }
   
    public function edit(Designation $designation)
    {
        return view('admin.system-management.designation.edit',compact('designation'));
    }
  
    public function update(Request $request, Designation $designation)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);
        
        $designation->update($request->all());
      
        return redirect()->route('designation.index')
            ->with('success','Designation updated successfully');
    }
  
    public function destroy(Designation $designation)
    {
        $designation->delete();
        return redirect()->route('designation.index')
            ->with('success','Subject deleted successfully');
    }

    public function search()
    { 
		$q = Input::get('q');
		if($q != ""){
		$user = Designation::where('name', 'LIKE', '%' . $q . '%')->paginate(7)->setPath('');
		$pagination = $user->appends(array(
				'q' => Input::get ( 'q' ) 
		));
		if (count ( $user ) > 0)
		return view ('admin.system-management.designation.index')->withDetails($user)->withQuery($q)->with('i',(request()->input('page', 1) - 1) * 5);
		}
		return view ('admin.system-management.designation.index')->withMessages('No Details found. Try to search again !');
	} 
}