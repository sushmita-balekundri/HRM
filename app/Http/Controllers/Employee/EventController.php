<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Event;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class EventController extends Controller
{  
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
        return view('employee.event-management.calendar', compact('calendar'));
    }
         
}