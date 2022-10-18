<?php

namespace App\Http\Controllers;
use App\User;
use App\Leave;
use App\Event;


use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    { 
        if (auth()->user()->role == 'Admin'){
            $user = User::all()->where('role', 'Employee');
            $event = Event::all();
            return view('admin.dashboard',compact('user','event'));
        }
        elseif(auth()->user()->role == 'Employee'){
            $user = User::where('id', auth()->user()->id)->first();
            $leave = Leave::all();
            $event = Event::all();
            return view('employee.dashboard',compact('user','leave','event'));
        }
    }

}
