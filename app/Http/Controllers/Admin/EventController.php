<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
     public function manageEvent(Request $request){
     
        $events = [];
            if(Auth::user()->role_name == 'Admin'){

                $appointments = Event::orderBy('event_start_date', 'desc')->take(5)->get();
    
                foreach ($appointments as $appointment) {
                    $events[] = [
                        'title' => $appointment->event_title,
                        'start' => $appointment->event_start_date,
                        'end' => $appointment->event_end_date,
                        'className' => 'fc-state-default',
                        'icon' => "circle",
                        'backgroundColor' => $appointment->event_color , // Default color agar database me nahi hai
                        'borderColor' => $appointment->event_color,
                        'event_description' => $appointment->event_description,
                       
                    ];
                }
            }
            else{
                
                $appointments =  EventUser::with('event')->where('user_id', Auth::id())->take(5)->get();
               
                foreach ($appointments as $appointment) {
                    $events[] = [
                        'title' => $appointment->event->event_title,
                        'start' => $appointment->event->event_start_date,
                        'end' => $appointment->event->event_end_date,
                        'className' => 'fc-state-default',
                        'icon' => "circle",
                        'backgroundColor' =>  $appointment->event->event_color, // Default color agar database me nahi hai
                        'borderColor' => $appointment->event->event_color,
                        'event_description' => $appointment->event->description,

    
                    ];
                }
            }
       
        return view('admin.event.manage_event', compact('events'));
     }


     public function save(Request $request){

        $employee_ids = $request->employee_id;
        
        $department_id         = $request->input('department_id');
        $employee_id         = $request->input('employee_id');
        $event_start_date         = $request->input('event_start_date');
        $event_end_date         = $request->input('event_end_date');
        $event_title         = $request->input('event_title');
        $event_color         = $request->input('event_color') == 'null' ? "#000000" : $request->input('event_color');
        $event_description         = $request->input('event_description');


        try {
                $event = new Event();
                $event->department_id = $department_id;
                $event->event_start_date = $event_start_date;
                $event->event_end_date = $event_end_date;
                $event->event_title = $event_title;
                $event->event_color = $event_color;
                $event->event_description = $event_description;


                if($event->save()){
                    foreach($employee_ids as $emp_id){
                            DB::table('event_users')->insert(['event_id'=> $event->id, 'user_id'=> $emp_id]);
                    }
                }
                $res['message'] = 'success';
            } catch (\Throwable $th) {
                $res['message'] = $th->getMessage();
            }
        return response ($res);
    }
}
