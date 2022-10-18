<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Event;
use App\User;
use App\Attendance;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Illuminate\Support\Facades\Input; 

class EventController extends Controller
{
    public function index()
    {
        $event = Event::latest()->paginate(7);
        return view('admin.event-management.index', compact('event'))
            ->with('i', (request()->input('page', 1) - 1) * 7);
        // return view('admin.event-management.index');
    }

    public function createEvent()
    {
        return view('admin.event-management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'string',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        
        Event::create($request->all());
        return redirect()->route('event-index')
                        ->with('success','Event has been added successfully');
    }

    public function calender()
    {
        $events = [];
        $data = Event::all();
        if($data->count())
            {
                foreach ($data as $key => $value) 
                    {
                        $events[] = Calendar::event(
                        $value->event_name,
                        true,
                        new \DateTime($value->start_date),
                        new \DateTime($value->end_date.'+1 day'),
                        null,
                        // Add color
                            
                        [
                            'color' => '#000000',
                            'textColor' => '#008000',  
                        ]
                        );
                    }
            }
            $calendar = Calendar::addEvents($events);
            return view('admin.event-management.calendar', compact('calendar'));
    }

    public function report(Attendance $attendance)
    {
        $user = User::where('emp_id', '!=', 'Admin')->paginate(7);
        $attendance = Attendance::all();
        return view('admin.system-management.report.index',compact('attendance','user'))
            ->with('i', (request()->input('page', 1) - 1) * 7);
    }

    public function search()
    { 
		$q = Input::get('q');
		if($q != ""){
		$user = Event::where('start_date', 'LIKE', '%' . $q . '%')->paginate(7)->setPath('');
		$pagination = $user->appends(array(
				'q' => Input::get ( 'q' ) 
		));
		if (count ( $user ) > 0)
		return view ('admin.event-management.index')->withDetails($user)->withQuery($q)->with('i',(request()->input('page', 1) - 1) * 5);
		}
		return view ('admin.event-management.index')->withMessages('No Details found. Try to search again !');
    } 
    
    public function search1()
    { 
        $q = Input::get('q');
        $attendance = Attendance::all();
		if($q != ""){
		$user = User::where('name', 'LIKE', '%' . $q . '%')->paginate(7)->setPath('');
		$pagination = $user->appends(array(
				'q' => Input::get ( 'q' ) 
		));
		if (count ( $user ) > 0)
		return view ('admin.system-management.report.index',compact('attendance'))->withDetails($user)->withQuery($q)->with('i',(request()->input('page', 1) - 1) * 5);
		}
		return view ('admin.system-management.report.index')->withMessages('No Details found. Try to search again !');
	} 
}