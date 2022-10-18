<?php
  
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\User;
use App\SalaryStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class SalaryStructureController extends Controller
{
   public function __construct()
   { 
       $this->middleware('admin');
   }
   
   public function index()
   {
       $struct = SalaryStructure::latest()->paginate(7);
       return view('admin.payroll-management.salary-structure.index',compact('struct'))
           ->with('i', (request()->input('page', 1) - 1) * 7);
   }
  
   public function create()
   {
      $user = User::where('role', 'Employee')->get();
      return view('admin.payroll-management.salary-structure.create',compact('user'));
   }

   public function store(Request $request)
   {
       $request->validate([
           'emp_id' => 'required',
           'name' => 'required',
           'designation' => 'required',
           'gross_salary' => 'required',
           'basic' => 'required',
           'hra' => 'required',
           'conveyance' => 'required',
           'esi' => 'required',
           'pf' => 'required',
           'spcl_allowance' => 'required',
           'performance_bonus' => 'required',
           'night_allowance' => 'required',
           'statutory_bonus' => 'required',
       ]);
       
       $request['gross_salary'] = str_replace(',', '', $request['gross_salary']);
       SalaryStructure::create($request->all());

       return redirect()->route('paystructure.index')
                       ->with('success','Pay-structure created successfully.');
    }

    public function show(SalaryStructure $paystructure)
    {
        return view('admin.payroll-management.salary-structure.show',compact('paystructure'));
    }
  
    public function edit(SalaryStructure $paystructure)
    {
        $user = User::where('role', 'Employee')->get();
        return view('admin.payroll-management.salary-structure.edit',compact('paystructure','user'));
    }
 
    public function update(Request $request, SalaryStructure $paystructure)
    {
        $request->validate([
          'emp_id' => 'required',
           'name' => 'required',
           'designation' => 'required',
           'gross_salary' => 'required',
           'basic' => 'required',
           'hra' => 'required',
           'conveyance' => 'required',
           'esi' => 'required',
           'pf' => 'required',
           'spcl_allowance' => 'required',
           'performance_bonus' => 'required',
           'night_allowance' => 'required',
           'statutory_bonus' => 'required',
        ]);
        $request['gross_salary'] = str_replace(',', '', $request['gross_salary']);
        $paystructure->update($request->all());
     
        return redirect()->route('paystructure.index')
            ->with('success','Updated successfully');
    }
 
    public function destroy(SalaryStructure $paystructure)
    {
        $paystructure->delete();
        return redirect()->route('paystructure.index')
           ->with('success','Deleted successfully');
    }

    public function search()
    { 
        $q = Input::get('q');
        if($q != ""){
        $user = SalaryStructure::where('emp_id', 'LIKE', '%' . $q . '%')->orWhere ( 'name', 'LIKE', '%' . $q . '%' )->paginate(7)->setPath('');
        $pagination = $user->appends(array(
           'q' => Input::get ( 'q' ) 
        ));
        if (count ( $user ) > 0)
            return view ('admin.payroll-management.salary-structure.index')->withDetails($user)->withQuery($q)->with('i',(request()->input('page', 1) - 1) * 5);
        }
        return view ('admin.payroll-management.salary-structure.index')->withMessages('No Details found. Try to search again !');
    }  
 
}