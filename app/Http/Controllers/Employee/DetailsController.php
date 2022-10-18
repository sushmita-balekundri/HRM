<?php
  
namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller; 
use App\User;
use Illuminate\Http\Request;
  
class DetailsController extends Controller
{
    public function __construct()
    { 
        $this->middleware('employee');
    }
   
    public function index(User $profile)
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('employee.profile.index',compact('user'));
    }
   
    public function create(User $profile)
    {
        $profile = User::where('id', auth()->user()->id)->first();
        return view('employee.profile.edit',compact('profile'));
    }

    public function update(Request $request, User $profile)
    {
        $request->validate([
            'name' => 'required',
            // 'password' => 'required',
            'blood_group' => 'required',
            'education' => 'required',
            'address' => 'required',
            'personal_no' => 'required',
            'emergency_no' => 'required',
        ]);
        // $request['password'] = bcrypt($request['password']);
        $data = $profile->update($request->all());
        
        return redirect()->route('profile.index')
            ->with('success','Profile updated successfully');
    }
  
}