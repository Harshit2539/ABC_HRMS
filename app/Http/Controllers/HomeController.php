<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\Holiday;
use App\Models\LeaveDetail;
use App\Models\TravelRecords;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use PDF;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // main dashboard
    public function index()
    {


        $role = Auth::user()->role_name;
        switch ($role) {
            case "HR":
                $leave_detail = LeaveDetail::where('approver1', Auth::id())->selectRaw('leave_status, count(*) as total')->groupBy('leave_status')->pluck('total', 'leave_status')->toArray();
                $travel_detail = TravelRecords::where('approver1', Auth::id())->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status')->toArray();
                break;
            case "Direct superior":
                $leave_detail = LeaveDetail::where('approver2', Auth::id())->selectRaw('leave_status, count(*) as total')->groupBy('leave_status')->pluck('total', 'leave_status')->toArray();
                $travel_detail = TravelRecords::where('approver2', Auth::id())->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status')->toArray();
                break;
            case "DGA":
                $leave_detail = LeaveDetail::where('approver3', Auth::id())->selectRaw('leave_status, count(*) as total')->groupBy('leave_status')->pluck('total', 'leave_status')->toArray();
                $travel_detail = TravelRecords::where('approver3', Auth::id())->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status')->toArray();
                break;
            case "Admin":
                $leave_detail = LeaveDetail::selectRaw('leave_status, count(*) as total')->groupBy('leave_status')->pluck('total', 'leave_status')->toArray();
                $travel_detail = TravelRecords::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status')->toArray();
                break;
            default:
                # code...
                break;
        }

        $today = Carbon::today()->toDateString();

        if (Auth::user()->name == "Admin") {
            $leave_detail = LeaveDetail::whereDate('from_date', '<=', $today)->whereDate('to_date', '>=', $today)->selectRaw('leave_status, count(*) as total')->groupBy('leave_status')->pluck('total', 'leave_status')->toArray();
            $travel_detail = TravelRecords::whereDate('travel_date', '<=', $today)->whereDate('return_date', '>=', $today)->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status')->toArray();

        } else {

            $leave_detail = LeaveDetail::where('approver1', Auth::id())->whereDate('from_date', '<=', $today)->whereDate('to_date', '>=', $today)->selectRaw('leave_status, count(*) as total')->groupBy('leave_status')->pluck('total', 'leave_status')->toArray();
            $travel_detail = TravelRecords::where('approver1', Auth::id())->whereDate('travel_date', '<=', $today)->whereDate('return_date', '>=', $today)->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status')->toArray();

        }

        $statusCounts = [
            'complete' => $leave_detail['complete'] ?? 0,
            'pending' => $leave_detail['pending'] ?? 0,
            'inprogress' => $leave_detail['inprogress'] ?? 0,
            'reject' => $leave_detail['reject'] ?? 0,
        ];

        $travelStatusCounts = [
            'complete' => $travel_detail['complete'] ?? 0,
            'pending' => $travel_detail['pending'] ?? 0,
            'inprogress' => $travel_detail['inprogress'] ?? 0,
            'reject' => $travel_detail['reject'] ?? 0,
        ];


        $divisionss = FacadesDB::table('divisions')->take(3)->get();

        $usersByStatus = FacadesDB::table('users')
            ->select('status', FacadesDB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->keyBy('status');  // Organize by status (Active, Inactive)

        // Calculate the total count
        $totalCount = $usersByStatus->sum('count');  // Sum of all counts

        $dataCounts = [
            'projects' => FacadesDB::table('projects')->where('status', 'Active')->count(),
            'travels' => FacadesDB::table('travel_records')->count(),
            'companies' => FacadesDB::table('company_structures')->count(),
            'roles' => FacadesDB::table('roles')->count(),
            'divisions' => FacadesDB::table('divisions')->count(),

        ];

        $currentYear = Carbon::now()->year; // Get current year
        $currentMonth = Carbon::now()->month; // Get current month  


        $current_month_holiday = Holiday::select('id', 'name_holiday', 'is_restrict')->whereYear('date_holiday', $currentYear)
            ->whereMonth('date_holiday', $currentMonth)
            ->get();
        $events = [];
        if (Auth::user()->role_name == 'Admin') {

            $appointments = Event::orderBy('event_start_date', 'desc')->take(5)->get();

            foreach ($appointments as $appointment) {
                $events[] = [
                    'title' => $appointment->event_title,
                    'start' => $appointment->event_start_date,
                    'end' => $appointment->event_end_date,
                    'className' => 'fc-state-default',
                    'icon' => "circle",
                    'backgroundColor' => $appointment->event_color, // Default color agar database me nahi hai
                    'borderColor' => $appointment->event_color,
                    'event_description' => $appointment->event_description,

                ];
            }
        } else {

            $appointments = EventUser::with('event')->where('user_id', Auth::id())->take(5)->get();

            foreach ($appointments as $appointment) {
                $events[] = [
                    'title' => $appointment->event->event_title,
                    'start' => $appointment->event->event_start_date,
                    'end' => $appointment->event->event_end_date,
                    'className' => 'fc-state-default',
                    'icon' => "circle",
                    'backgroundColor' => $appointment->event->event_color, // Default color agar database me nahi hai
                    'borderColor' => $appointment->event->event_color,
                    'event_description' => $appointment->event->description,
                ];
            }
        }

        $month = now()->month;
        // Get current month join count
        $currentMonthJoinCount = DB::table('employees')
            ->whereMonth('joined_date', now()->month)
            ->whereYear('joined_date', now()->year)
            ->count();

        $workAnniversaryCount = DB::table('employees')
            ->whereMonth('joined_date', now()->month)
            ->count();

        $birthdayCount = DB::table('employees')
            ->whereMonth('birthday', now()->month)
            ->count();

        $department = DB::table('departments')
            ->count();


        return view('dashboard.dashboard', compact('month', 'events', 'dataCounts', 'usersByStatus', 'totalCount', 'statusCounts', 'travelStatusCounts', 'divisionss', 'current_month_holiday', 'currentMonthJoinCount', 'workAnniversaryCount', 'birthdayCount','department'));
    }

    public function authenticateLoader()
    {

        return view('dashboard.loginLoder');
    }
    // employee dashboard
    public function emDashboard()
    {
        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        return view('dashboard.emdashboard', compact('todayDate'));
    }

    public function generatePDF(Request $request)
    {
        // $data = ['title' => 'Welcome to ItSolutionStuff.com'];
        // $pdf = PDF::loadView('payroll.salaryview', $data);
        // return $pdf->download('text.pdf');
        // selecting PDF view
        $pdf = PDF::loadView('payroll.salaryview');
        // download pdf file
        return $pdf->download('pdfview.pdf');
    }



}
