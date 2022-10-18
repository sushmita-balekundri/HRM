<?php
  
namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller; 
use App\Salary;
use Illuminate\Http\Request;
use App\SalaryStructure;
use PDF;
use App\User;
class PayrollController extends Controller
{
    public function __construct(Salary $salary, User $user, SalaryStructure $structure)
    { 
        $this->salary = $salary;
        $this->user = $user;
        $this->structure = $structure;
        $this->middleware('employee');
    }
    
    public function index()
    {
        $salary = Salary::all();
        return view('employee.payroll-management.index',compact('salary'));
    }
   
    public function pdfview($id)
    {  
        $salary = $this->salary->findOrFail($id);
        $user = $this->user->all();
        $structure = $this->structure->all();
        $pdf = PDF::loadView('employee.payroll-management.pdfview', compact('salary','user','structure'))->setPaper('a4');
        return $pdf->download(str_replace(' ', '-', $salary->name).'/'.$salary->month.'/'.$salary->year.'.pdf');  
    }
}