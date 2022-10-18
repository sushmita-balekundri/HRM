<?php
  
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\User;
use App\Salary;
use App\SalaryStructure;
use App\Attendance;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Input;
class PayrollController extends Controller
{
    protected $salary; 

    public function __construct(Salary $salary, User $user, SalaryStructure $structure)
    { 
        $this->salary = $salary;
        $this->user = $user;
        $this->structure = $structure;
        $this->middleware('admin');
    }
    
    public function index()
    {
        $salary = Salary::latest()->paginate(7);
        return view('admin.payroll-management.index',compact('salary'))
            ->with('i', (request()->input('page', 1) - 1) * 7);

    }

    public function create()
    {
        $user = SalaryStructure::all(); 
        $atten = Attendance::all(); 
        return view('admin.payroll-management.create',compact('user','atten'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'emp_id' => 'required',
            'month' => 'required',
            'year' => 'required',
            'basic_salary' => 'required',
            'tax' => 'required', 
            'esi' => 'required',
            'pf' => 'required',
            'total_working_days' => 'required',
            'present_days' => 'required',
            'lop_days' => 'required',
            'day_salary' => 'required',
            'lop' => 'required',
            'deduction' => 'required',
            'net_salary' => 'required', 
        ]);
        
        $request['basic_salary'] = str_replace(',', '', $request['basic_salary']);
        Salary::create($request->all());

        return redirect()->route('payroll.index')
            ->with('success','Updated successfully.');
    }

    public function view($id)
    {
        $salary = $this->salary->findOrFail($id);
        $user = $this->user->all();
        $structure = $this->structure->all();
        return view('admin.payroll-management.show',compact('salary','user','structure'));
    }

    public function pdfview($id)
    { 
        $salary = $this->salary->findOrFail($id);
        $user = $this->user->all();
        $structure = $this->structure->all();
        $pdf = PDF::loadView('admin.payroll-management.pdfview', compact('salary','user','structure'))->setPaper('a4');
        return $pdf->download(str_replace(' ', '', $salary->name).'-'.$salary->month.'-'.$salary->year.'.pdf');
    }

    public function search()
    { 
        $q = Input::get('q');
        if($q != ""){
        $user = Salary::where('emp_id', 'LIKE', '%' . $q . '%')->orWhere ( 'name', 'LIKE', '%' . $q . '%' )->paginate(7)->setPath('');
        $pagination = $user->appends(array(
           'q' => Input::get ( 'q' ) 
        ));
        if (count ( $user ) > 0)
            return view ('admin.payroll-management.index')->withDetails($user)->withQuery($q)->with('i',(request()->input('page', 1) - 1) * 5);
        }
        return view ('admin.payroll-management.index')->withMessages('No Details found. Try to search again !');
    }  

}