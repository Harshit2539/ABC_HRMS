<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnnualLeave;
use App\Models\Employee;
use App\Models\EmployeeAnnualLeave;
use App\Models\EmployeeLoans;
use App\Models\LeaveDetail;
use App\Models\TravelRecords;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\EmployeeSeparationDetail;

class AllRequestController extends Controller
{

    public function exitEmployee(Request $request)
    {
        $month = $request->input('month') ?? now()->month;
       $lastDay = EmployeeSeparationDetail::whereMonth('tentative_leaving_date', $month)
                ->join('employees', 'employee_separation_details.employee_id', '=', 'employees.id')
                ->select(
                    'employee_separation_details.id',
                    'employees.first_name',
                    'employees.last_name',
                    'employee_separation_details.tentative_leaving_date'
                )
                ->get();
        return response()->json(['status'=>true, 'lastDays'=>$lastDay , 'month'=>$month ]);
    }
    public function getSeriviceChartData()
    {
        $today = new \DateTime();

        $employees = Employee::select('id', 'joined_date')->get();

        $buckets = [
            '< 1' => 0,
            '1-2' => 0,
            '2-3' => 0,
            '3-4' => 0,
            '4-5' => 0,
            '5-6' => 0,
            '6-7' => 0,
            '7-8' => 0,
            '8-9' => 0,
            '9-10' => 0,
            '> 10' => 0,
        ];

        foreach ($employees as $employee) {
            $joinedDate = new \DateTime($employee->joined_date);
            $years = $today->diff($joinedDate)->y;
            $months = $today->diff($joinedDate)->m;

            $exactYears = $years + $months / 12;

            if ($exactYears < 1) {
                $buckets['< 1']++;
            } elseif ($exactYears >= 1 && $exactYears < 2) {
                $buckets['1-2']++;
            } elseif ($exactYears >= 2 && $exactYears < 3) {
                $buckets['2-3']++;
            } elseif ($exactYears >= 3 && $exactYears < 4) {
                $buckets['3-4']++;
            } elseif ($exactYears >= 4 && $exactYears < 5) {
                $buckets['4-5']++;
            } elseif ($exactYears >= 5 && $exactYears < 6) {
                $buckets['5-6']++;
            } elseif ($exactYears >= 6 && $exactYears < 7) {
                $buckets['6-7']++;
            } elseif ($exactYears >= 7 && $exactYears < 8) {
                $buckets['7-8']++;
            } elseif ($exactYears >= 8 && $exactYears < 9) {
                $buckets['8-9']++;
            } elseif ($exactYears >= 9 && $exactYears < 10) {
                $buckets['9-10']++;
            } else {
                $buckets['> 10']++;
            }
        }

        return response()->json([
            'status' => true,
            'years_in_service_distribution' => $buckets
        ]);
        // return response()->json($data);
    }

    public function ctc()
    {
        $today = Carbon::now();
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $date = $today->copy()->subMonths($i);
            $months->push([
                'month' => $date->month,
                'year' => $date->year,
                'label' => $date->format('M Y'),
                'total_salary' => 0
            ]);
        }
        $startDate = $today->copy()->subMonths(5)->startOfMonth();
        $endDate = $today->copy()->endOfMonth();

        $dbData = DB::table('employee_payslip')
            ->select('current_month', 'year', DB::raw('SUM(gross_salary) AS total_salary'))
            ->whereBetween('released_date', [$startDate->toDateString(), $endDate->toDateString()])
            ->groupBy('year', 'current_month')
            ->get()
            ->keyBy(function ($item) {
                return $item->year . '-' . str_pad($item->current_month, 2, '0', STR_PAD_LEFT);
            });
        $seriesData = $months->map(function ($item) use ($dbData) {
            $key = $item['year'] . '-' . str_pad($item['month'], 2, '0', STR_PAD_LEFT);
            if ($dbData->has($key)) {
                $item['total_salary'] = round((float) $dbData[$key]->total_salary, 2);
            }
            return ['name' => $item['label'], 'y' => $item['total_salary']];
        });

        return response()->json($seriesData);
    }

    // public function ctc()
    // {
    //     $today = Carbon::now();
    //     $startDate = $today->copy()->subMonths(11)->startOfMonth();

    //     $groupedData = DB::table('employee_payslip')
    //         ->select('current_month','year',
    //             DB::raw('SUM(gross_salary) AS total_salary'),
    //             DB::raw('MIN(released_date) as min_date'))
    //         ->whereBetween('released_date', [$startDate->toDateString(), $today->endOfMonth()->toDateString()])
    //         ->groupBy('year', 'current_month')
    //         ->orderByRaw('MIN(released_date) DESC')
    //         ->limit(6)
    //         ->get()
    //         ->sortBy(function ($row) {
    //             return $row->year * 100 + (int) $row->current_month;
    //         })
    //         ->values();

    //     $seriesData = $groupedData->map(function ($row) {
    //         $month = Carbon::createFromFormat('!m', $row->current_month)->format('M') . ' ' . $row->year;
    //         return ['name' => $month, 'y' => round((float) $row->total_salary, 2)];
    //     });

    //     return response()->json($seriesData);
    // }

    public function work(Request $request)
    {
        $month = $request->input('month') ?? now()->month;

        $today = now();
        $employees = Employee::whereMonth('joined_date', $month)
            ->select('id', 'first_name', 'last_name', 'joined_date')
            ->get()
            ->map(function ($employee) use ($today) {
                $years = $today->year - Carbon::parse($employee->joined_date)->year;
                return [
                    'id' => $employee->id,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name,
                    'work' => $employee->joined_date,
                    'anniversary_count' => $years
                ];
            });

        return response()->json([
            'status' => true,
            'work' => $employees,
            'month' => $month
        ]);
    }

    public function getLeaveChartData()
    {
        $data = DB::table('employee_annual_leaves')
            ->leftJoin('employees', 'employees.employee_id', '=', 'employee_annual_leaves.user_id')
            ->select(
                DB::raw('CONCAT(employees.first_name, " ", employees.last_name) as name'),
                'employees.olm_id as Emp_id',
                DB::raw('(employee_annual_leaves.annual_leave + employee_annual_leaves.sick_leave) as total')
            )
            ->orderByDesc(DB::raw('(employee_annual_leaves.annual_leave + employee_annual_leaves.sick_leave)'))
            ->limit(5)
            ->get();

        return response()->json($data);
    }



    public function getAgeChartData()
    {
        $today = Carbon::today();

        $employees = DB::table('employees')
            ->select('birthday')
            ->whereNotNull('birthday')
            ->get();

        $ageGroups = [
            '10-19' => 0,
            '20-29' => 0,
            '30-39' => 0,
            '40-49' => 0,
            '50-59' => 0,
            '60-69' => 0,
            '70-79' => 0,
            '80-89' => 0,
            '90+' => 0,
        ];

        foreach ($employees as $emp) {
            $birthday = Carbon::parse($emp->birthday);
            $age = $birthday->diffInYears($today);

            switch (true) {
                case $age >= 10 && $age <= 19:
                    $ageGroups['10-19']++;
                    break;
                case $age >= 20 && $age <= 29:
                    $ageGroups['20-29']++;
                    break;
                case $age >= 30 && $age <= 39:
                    $ageGroups['30-39']++;
                    break;
                case $age >= 40 && $age <= 49:
                    $ageGroups['40-49']++;
                    break;
                case $age >= 50 && $age <= 59:
                    $ageGroups['50-59']++;
                    break;
                case $age >= 60 && $age <= 69:
                    $ageGroups['60-69']++;
                    break;
                case $age >= 70 && $age <= 79:
                    $ageGroups['70-79']++;
                    break;
                case $age >= 80 && $age <= 89:
                    $ageGroups['80-89']++;
                    break;
                case $age >= 90:
                    $ageGroups['90+']++;
                    break;
            }
        }
        $result = [];
        foreach ($ageGroups as $range => $count) {
            $result[] = ['name' => $range, 'total' => $count];
        }

        return response()->json($result);
    }
    public function getJoiningChartData()
    {
        $joined = DB::table('employees')
            ->selectRaw('MONTH(joined_date) as month, COUNT(*) as total')
            ->whereNotNull('joined_date')
            ->groupBy(DB::raw('MONTH(joined_date)'))
            ->pluck('total', 'month')
            ->toArray();

        $resigned = DB::table('employees')
            ->selectRaw('MONTH(termination_date) as month, COUNT(*) as total')
            ->whereNotNull('termination_date')
            ->groupBy(DB::raw('MONTH(termination_date)'))
            ->pluck('total', 'month')
            ->toArray();


        // Build final arrays of 12 months
        $joinedData = [];
        $resignedData = [];
        for ($i = 1; $i <= 12; $i++) {
            $joinedData[] = $joined[$i] ?? 0;
            $resignedData[] = $resigned[$i] ?? 0;
        }


        return response()->json([
            'joined' => $joinedData,
            'resigned' => $resignedData
        ]);
    }

    public function getCountryChartData()
    {
        $data = DB::table('countries')
            ->leftJoin('employees', 'countries.id', '=', 'employees.country')
            ->select('countries.name as name', DB::raw('COUNT(employees.id) as total'))
            ->groupBy('countries.name')
            ->get();
        return response()->json($data);
    }
    public function getGenderChartData()
    {
        $data = DB::table('employees')
            ->select('gender as name', DB::raw('COUNT(employees.id) as total'))
            ->groupBy('gender')
            ->get();
        return response()->json($data);
    }





    public function birthdays(Request $request)
    {
        $month = $request->input('month') ?? now()->month;
        $birthdays = Employee::whereMonth('birthday', $month)->select('id', 'first_name', 'last_name', 'birthday')->get();
        return response()->json(['status' => true, 'birthdays' => $birthdays, 'month' => $month]);
    }

    public function getDepartmentChartData()
    {
        $data = DB::table('departments')
            ->leftJoin('employees', 'departments.id', '=', 'employees.department')
            ->select('departments.department as name', DB::raw('COUNT(employees.id) as total'))
            ->groupBy('departments.department')
            ->get();
        return response()->json($data);
    }


    // public function travel_request(Request $request){

    //     $current_user_role = Auth::user()->role_name;
    //     $role = $current_user_role;


    //     switch ($role) {
    //     case "HR":
    //         $data = TravelRecords::where('approver1', Auth::user()->id)->get();
    //         break;
    //     case "Direct superior":
    //         $data = TravelRecords::where('approver2', Auth::user()->id)->get();
    //         break;
    //     case "DGA":
    //         $data = TravelRecords::where('approver3', Auth::user()->id)->get();
    //         break;
    //     case "Admin":
    //         $data = TravelRecords::where('approver1', Auth::user()->id)
    //                 ->orWhere('approver2', Auth::user()->id)
    //                 ->orWhere('approver3', Auth::user()->id)->get();
    //         break;    
    //     default:
    //         echo "sorry no role assigne, first assigne your role";
    //     }



    //     if ($request->ajax()) {
    //         return DataTables::of($data)
    //         ->addColumn('type', function ($data) {
    //             return $data->type;
    //         })
    //         ->addColumn('purpose', function ($data) {
    //             return $data->purpose;
    //         })
    //         ->addColumn('status', function ($data) {
    //             if (!empty($data->status)) {
    //                 if ($data->status === 'reject') {
    //                     return '<span class="badge bg-inverse-danger">Reject</span>';
    //                 } elseif ($data->status === 'complete') {
    //                     return '<span class="badge bg-inverse-success">Complete</span>';
    //                 }elseif ($data->status === 'pending') {
    //                     return '<span class="badge bg-inverse-primary">Pending</span>';
    //                 }elseif ($data->status === 'inprogress') {
    //                     return '<span class="badge bg-inverse-warning">Inprogress</span>';
    //                 }
    //             }
    //             return '<span class="badge bg-secondary">Unknown</span>'; // Fallback for unknown status
    //         })
    //         ->addColumn("action", function ($data) {
    //             $current_user_role = Auth::user()->role_name; // Get the current user's role
    //             $button = '';
    //             switch ($current_user_role) {
    //                 case "HR":
    //                     if ($data->approve1 == 1) {
    //                         $button .= '<div class="text-center" style="display:inline">
    //                                         <button class="btn btn-success btn-approve" 
    //                                                 style="font-size:smaller; font-weight:bold;" 
    //                                                 disabled>Approved</button>
    //                                    </div>';
    //                     } else {
    //                         $button .= '
    //                                    <div class="text-center" style="display:inline">
    //                                         <a href="javascript:void(0)" 
    //                                            class="btn btn-info btn-approve"
    //                                            style="font-size:smaller; font-weight:bold;" 
    //                                            data-id="' . $data->id . '">Approved as HR</a>
    //                                    </div>'
    //                                    ;

    //                     }

    //                     break;

    //                 case "Direct superior":
    //                     // Example for Direct superior
    //                     if ($data->approve2 == 1) {
    //                         $button .= '<div class="text-center" style="display:inline">
    //                                         <button class="btn btn-success btn-approve" 
    //                                                 style="font-size:smaller; font-weight:bold;" 
    //                                                 disabled>Approved</button>
    //                                    </div>';
    //                     } else {
    //                         $button .= '<div class="text-center" style="display:inline">
    //                                         <a href="javascript:void(0)" 
    //                                            class="btn btn-warning btn-approve"
    //                                            style="font-size:smaller; font-weight:bold;" 
    //                                            data-id="' . $data->id . '">Approve as Supervisor</a>
    //                                    </div>';
    //                     }
    //                     break;








    //                     case "Admin":
    //                         // Example for Direct superior
    //                         if ($data->approve1 == 1 || $data->approve2 == 2 || $data->approve3 == 3) {
    //                             $button .= '<div class="text-center" style="display:inline">
    //                                             <button class="btn btn-success btn-approve" 
    //                                                     style="font-size:smaller; font-weight:bold;" 
    //                                                     disabled>Approved</button>
    //                                        </div>';
    //                         } else {
    //                             $button .= '<div class="text-center" style="display:inline">
    //                                             <a href="javascript:void(0)" 
    //                                                class="btn btn-warning btn-approve"
    //                                                style="font-size:smaller; font-weight:bold;" 
    //                                                data-id="' . $data->id . '">Approve as Admin</a>
    //                                        </div>';
    //                         }
    //                         break;    

    //                 case "DGA":
    //                     // Example for DGA
    //                     if ($data->approve3 == 1) {
    //                         $button .= '<div class="text-center" style="display:inline">
    //                                         <button class="btn btn-success btn-approve" 
    //                                                 style="font-size:smaller; font-weight:bold;" 
    //                                                 disabled>Approved</button>
    //                                    </div>';
    //                     } else {
    //                         $button .= '<div class="text-center" style="display:inline">
    //                                         <a href="javascript:void(0)" 
    //                                            class="btn btn-primary btn-approve"
    //                                            style="font-size:smaller; font-weight:bold;" 
    //                                            data-id="' . $data->id . '">Approve as DGA</a>
    //                                    </div>';
    //                     }
    //                     break;

    //                 default:
    //                     $button = '<div class="text-center">
    //                                     <span class="text-danger">No actions available</span>
    //                                </div>';
    //                     break;
    //             }

    //             $button .= '<div class="text-center" style="display:inline">
    //                 <button class="btn btn-primary btn-view" 
    //                         style="font-size:smaller; font-weight:bold;" 
    //                         data-id="' . $data->id . '" 
    //                         data-toggle="modal" 
    //                         data-target="#travelRequestModal">View</button>
    //            </div>';
    //            $button .= '<div class="text-center" style="display:inline"><a href="javascript:void(0)" 
    //                         class="btn btn-primary btn-reject"
    //                         style="font-size:smaller; font-weight:bold;" 
    //                         data-id="' . $data->id . '">Reject</a>
    //                         </div>
    //                         ';




    //             return $button;
    //         })
    //         ->rawColumns(['status', 'action']) // Render badges properly
    //         ->make(true);
    //     }

    //     return view('admin.travelRequest.list');

    // }




    public function travel_request(Request $request)
    {

        if (Auth::user()->role_name == "Admin") {

            $data = TravelRecords::get();
        } else {
            $data = TravelRecords::where('approver1', Auth::user()->id)->get();
        }


        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('type', function ($data) {
                    return $data->type;
                })
                ->addColumn('purpose', function ($data) {
                    return $data->purpose;
                })
                ->addColumn('status', function ($data) {
                    if (!empty($data->status)) {
                        if ($data->status === 'reject') {
                            return '<span class="badge bg-inverse-danger">Reject</span>';
                        } elseif ($data->status === 'complete') {
                            return '<span class="badge bg-inverse-success">Complete</span>';
                        } elseif ($data->status === 'pending') {
                            return '<span class="badge bg-inverse-primary">Pending</span>';
                        } elseif ($data->status === 'inprogress') {
                            return '<span class="badge bg-inverse-warning">Inprogress</span>';
                        }
                    }
                    return '<span class="badge bg-secondary">Unknown</span>'; // Fallback for unknown status
                })
                ->addColumn("action", function ($data) {
                    $button = '';

                    if ($data->is_reject == 0) {
                        if ($data->approve1 == 1) {
                            $button .= '<div class="text-center" style="display:inline">
                                           <button class="btn btn-success btn-approve"
                                                   style="font-size:smaller; font-weight:bold;"
                                                   disabled>Approved</button>
                                      </div>';
                        } else {

                            if (Auth::user()->id == $data->approver1) {

                                $button .= '
                                      <div class="text-center" style="display:inline">
                                           <a href="javascript:void(0)"
                                              class="btn btn-info btn-approve"
                                              style="font-size:smaller; font-weight:bold;"
                                              data-id="' . $data->id . '">Approve</a>
                                      </div>'
                                ;

                            }
                        }
                    }

                    $button .= '<div class="text-center" style="display:inline">
                   <button class="btn btn-primary btn-view"
                           style="font-size:smaller; font-weight:bold;"
                           data-id="' . $data->id . '"
                           data-toggle="modal"
                           data-target="#travelRequestModal">View</button>
              </div>';

                    if ($data->is_reject == 0 && $data->status != "complete") {
                        if (Auth::user()->id == $data->approver1) {

                            $button .= '<div class="text-center" style="display:inline"><a href="javascript:void(0)"
               class="btn btn-primary btn-reject"
               style="font-size:smaller; font-weight:bold;"
               data-id="' . $data->id . '">Reject</a>
               </div>';

                        }
                    }

                    return $button;


                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.travelRequest.list');

    }


    // public function approveTravelRequest(Request $request)
    // {
    //     $travelRecord = TravelRecords::find($request->id);


    //     if ($travelRecord) {

    //         $current_user_role = Auth::user()->role_name;
    //         $role = $current_user_role;



    //         switch ($role) {
    //         case "HR":
    //             $travelRecord->approve1 = 1; 
    //             break;
    //         case "Direct superior":
    //             if((!empty($travelRecord->approver1) && $travelRecord->approve1 != 1)){
    //                 return response()->json(['error' => 'Approver1 has not approved this request']);
    //             }
    //             $travelRecord->approve2 = 1; 
    //             break;
    //         case "DGA":
    //             if((!empty($travelRecord->approver1) && $travelRecord->approve1 != 1)){
    //                 return response()->json(['error' => 'Approver1 has not approved this request']);
    //             }elseif((!empty($travelRecord->approver2) && $travelRecord->approve2 != 1)){
    //                 return response()->json(['error' => 'Approver2 has not approved this request']);
    //             }
    //         case "Admin":

    //             $travelRecord->approve1 = 1; 
    //             $travelRecord->approve2 = 1;
    //             $travelRecord->approve3 = 1;
    //             break;
    //         default:
    //             echo "sorry no role assigne, first assigne your role";
    //         }

    //         if (
    //             (!empty($travelRecord->approver1) && empty($travelRecord->approve1)) ||
    //             (!empty($travelRecord->approver2) && empty($travelRecord->approve2)) ||
    //             (!empty($travelRecord->approver3) && empty($travelRecord->approve3))
    //         ) {
    //             $travelRecord->status = 'inprogress';
    //         } else {
    //             $travelRecord->status = 'complete';
    //         }
    //         $travelRecord->save();
    //         return response()->json(['success' => 'Travel request approved successfully!']);
    //     }
    //     return response()->json(['error' => 'Travel record not found.']);
    // }


    public function approveTravelRequest(Request $request)
    {
        $travelRecord = TravelRecords::find($request->id);

        if ($travelRecord) {

            $travelRecord->approve1 = 1;
            $travelRecord->status = 'complete';
            $travelRecord->save();
            return response()->json(['success' => 'Travel request approved successfully!']);
        }
        return response()->json(['error' => 'Travel record not found.']);
    }

    public function getTravelRequestDetails($id)
    {
        $travelRequest = TravelRecords::with(['employee', 'approver1', 'approver2', 'approver3'])->find($id); // Fetch the travel request by ID
        if ($travelRequest) {
            return response()->json($travelRequest);
        } else {
            return response()->json(['message' => 'Travel Request not found'], 404);
        }
    }

    public function rejectTravelRequest(Request $request)
    {

        $travel_request = TravelRecords::find($request->id);
        $travel_request->who_reject = Auth::id();
        $travel_request->is_reject = 1;
        $travel_request->status = 'reject';
        $travel_request->reject_reason = $request->reason;
        if ($travel_request->save()) {
            return response()->json(['success' => 'Travel request rejected successfully!']);
        } else {
            return response()->json(['error' => 'Something Went Wrong']);
        }
    }

    // public function leave_request(Request $request){

    //     $current_user_role = Auth::user()->role_name;
    //     $role = $current_user_role;

    //     switch ($role) {
    //     case "HR":
    //         $data = LeaveDetail::with(['user', 'approver1', 'approver2', 'approver3'])->where('approver1', Auth::user()->id)->get();
    //         break;
    //     case "Direct superior":
    //         $data = LeaveDetail::with(['user', 'approver1', 'approver2', 'approver3'])->where('approver2', Auth::user()->id)->get();
    //         break;
    //     case "DGA":
    //         $data = LeaveDetail::with(['user', 'approver1', 'approver2', 'approver3'])->where('approver3', Auth::user()->id)->get();
    //         break;
    //     case "Employee":
    //         $data = LeaveDetail::with(['user', 'approver1', 'approver2', 'approver3'])->where('user_id', Auth::user()->id)->get();
    //         break;    
    //     default:
    //         echo "sorry no role assigne, first assigne your role";
    //     }

    //     if ($request->ajax()) {
    //         return DataTables::of($data)

    //         ->addColumn('type', function ($data) {
    //             return $data->leave_type;
    //         })
    //         ->addColumn('from_date', function ($data) {
    //             return $data->from_date;
    //         })
    //         ->addColumn('to_date', function ($data) {
    //             return $data->from_date;
    //         })
    //         ->addColumn('status', function ($data) {
    //             if($data->is_reject == 1){
    //                 return 'Reject';
    //             }else{
    //                 if ($data->approver1 && is_null($data->approve1)) {
    //                     return 'Pending (Awaiting Approver 1)';
    //                 } elseif ($data->approver2 && is_null($data->approve2)) {
    //                     return 'Pending (Awaiting Approver 2)';
    //                 } elseif ($data->approver3 && is_null($data->approve3)) {
    //                     return 'Pending (Awaiting Approver 3)';
    //                 } elseif ($data->approve1 == 1 && $data->approve2 == 1 && $data->approve3 == 1) {
    //                     return 'Approved';
    //                 } else {
    //                     return 'Approved';
    //                 }
    //             }
    //         })
    //         ->addColumn("action", function ($data) {
    //             $current_user_role = Auth::user()->role_name; // Get the current user's role
    //             $button = '';
    //             switch ($current_user_role) {
    //                 case "HR":
    //                     if($data->is_reject == 0){
    //                         if ($data->approve1 == 1) {
    //                             $button .= '<div class="text-center" style="display:inline">
    //                                             <button class="btn btn-success btn-approve" 
    //                                                     style="font-size:smaller; font-weight:bold;" 
    //                                                     disabled>Approved</button>
    //                                        </div>';
    //                         } else {

    //                             $button .= '<div class="text-center" style="display:inline">
    //                                             <a href="javascript:void(0)" 
    //                                                class="btn btn-info btn-approve"
    //                                                style="font-size:smaller; font-weight:bold;" 
    //                                                data-id="' . $data->id . '">Approve as HR</a>
    //                                        </div>';

    //                         }
    //                     }

    //                     break;

    //                 case "Direct superior":
    //                     // Example for Direct superior
    //                     if($data->is_reject == 0){

    //                     if ($data->approve2 == 1) {
    //                         $button .= '<div class="text-center" style="display:inline">
    //                                         <button class="btn btn-success btn-approve" 
    //                                                 style="font-size:smaller; font-weight:bold;" 
    //                                                 disabled>Approved</button>
    //                                    </div>';
    //                     } else {
    //                         $button .= '<div class="text-center" style="display:inline">
    //                                         <a href="javascript:void(0)" 
    //                                            class="btn btn-warning btn-approve"
    //                                            style="font-size:smaller; font-weight:bold;" 
    //                                            data-id="' . $data->id . '">Approve as Supervisor</a>
    //                                    </div>';

    //                     }
    //                 }
    //                     break;

    //                 case "DGA":
    //                     // Example for DGA
    //                     if($data->is_reject == 0){

    //                     if ($data->approve3 == 1) {
    //                         $button .= '<div class="text-center" style="display:inline">
    //                                         <button class="btn btn-success btn-approve" 
    //                                                 style="font-size:smaller; font-weight:bold;" 
    //                                                 disabled>Approved</button>
    //                                    </div>';
    //                     } else {
    //                         $button .= '<div class="text-center" style="display:inline">
    //                                         <a href="javascript:void(0)" 
    //                                            class="btn btn-primary btn-approve"
    //                                            style="font-size:smaller; font-weight:bold;" 
    //                                            data-id="' . $data->id . '">Approve as DGA</a>
    //                                    </div>';

    //                     }
    //                 }
    //                     case "Employee":
    //                         // Example for DGA


    //                     break;

    //                 default:
    //                     $button = '<div class="text-center">
    //                                     <span class="text-danger">No actions available</span>
    //                                </div>';
    //                     break;
    //             }

    //             $button .= '<div class="text-center" style="display:inline">
    //                 <button class="btn btn-primary btn-view" 
    //                         style="font-size:smaller; font-weight:bold;" 
    //                         data-id="' . $data->id . '" 
    //                         data-toggle="modal" 
    //                         data-target="#travelRequestModal">View</button>
    //            </div>';
    //            if($data->is_reject == 0){
    //             $button .= '<a href="javascript:void(0)" 
    //             class="btn btn-primary btn-reject"
    //             style="font-size:smaller; font-weight:bold;" 
    //             data-id="' . $data->id . '">Reject</a>';
    //            }


    //             return $button;
    //         })
    //         ->make(true);
    //     }

    //     return view('admin.leaveRequest.list');

    // }

    // public function leave_request(Request $request){

    //     $current_user_role = Auth::user()->role_name;
    //     $role = $current_user_role;



    //     switch ($role) {
    //     case "HR":
    //         $data = LeaveDetail::with(['user', 'approver1', 'approver2', 'approver3'])->where('approver1', Auth::user()->id)->get();
    //         break;
    //     case "Direct superior":
    //         $data = LeaveDetail::with(['user', 'approver1', 'approver2', 'approver3'])->where('approver2', Auth::user()->id)->get();
    //         break;
    //     case "DGA":
    //         $data = LeaveDetail::with(['user', 'approver1', 'approver2', 'approver3'])->where('approver3', Auth::user()->id)->get();
    //         break;
    //     case "Employee":
    //         $data = LeaveDetail::with(['user', 'approver1', 'approver2', 'approver3'])->where('user_id', Auth::user()->id)->get();
    //         break; 
    //     case "Admin":
    //         $data = TravelRecords::where('approver1', Auth::user()->id)
    //                 ->orWhere('approver2', Auth::user()->id)
    //                 ->orWhere('approver3', Auth::user()->id)->get();
    //         break;      
    //     default:
    //         echo "sorry no role assigne, first assigne your role";
    //     }

    //     if ($request->ajax()) {
    //         return DataTables::of($data)

    //         ->addColumn('type', function ($data) {
    //             return $data->leave_type;
    //         })
    //         ->addColumn('from_date', function ($data) {
    //             return $data->from_date;
    //         })
    //         ->addColumn('to_date', function ($data) {
    //             return $data->to_date;
    //         })
    //         ->addColumn('status', function ($data) {
    //             if($data->is_reject == 1){
    //                 return 'Reject';
    //             }else{
    //                 if ($data->approver1 && is_null($data->approve1)) {
    //                     return 'Pending (Awaiting Reporting Manager)';
    //                 } elseif ($data->approver2 && is_null($data->approve2)) {
    //                     return 'Pending (Awaiting Approver 2)';
    //                 } elseif ($data->approver3 && is_null($data->approve3)) {
    //                     return 'Pending (Awaiting Approver 3)';
    //                 } elseif ($data->approve1 == 1 && $data->approve2 == 1 && $data->approve3 == 1) {
    //                     return 'Approved';
    //                 } else {
    //                     return 'Approved';
    //                 }
    //             }
    //         })
    //         ->addColumn("action", function ($data) {
    //             $current_user_role = Auth::user()->role_name; // Get the current user's role
    //             $button = '';
    //             switch ($current_user_role) {
    //                 case "HR":
    //                     if($data->is_reject == 0){
    //                         if ($data->approve1 == 1) {
    //                             $button .= '<div class="text-center" style="display:inline">
    //                                             <button class="btn btn-success btn-approve"
    //                                                     style="font-size:smaller; font-weight:bold;"
    //                                                     disabled>Approved</button>
    //                                        </div>';
    //                         } else {

    //                             $button .= '<div class="text-center" style="display:inline">
    //                                             <a href="javascript:void(0)"
    //                                                class="btn btn-info btn-approve"
    //                                                style="font-size:smaller; font-weight:bold;"
    //                                                data-id="' . $data->id . '">Approve As Reporting Manager</a>
    //                                        </div>';

    //                         }
    //                     }

    //                     break;

    //                 case "Direct superior":
    //                     // Example for Direct superior
    //                     if($data->is_reject == 0){

    //                     if ($data->approve2 == 1) {
    //                         $button .= '<div class="text-center" style="display:inline">
    //                                         <button class="btn btn-success btn-approve"
    //                                                 style="font-size:smaller; font-weight:bold;"
    //                                                 disabled>Approved</button>
    //                                    </div>';
    //                     } else {
    //                         $button .= '<div class="text-center" style="display:inline">
    //                                         <a href="javascript:void(0)"
    //                                            class="btn btn-warning btn-approve"
    //                                            style="font-size:smaller; font-weight:bold;"
    //                                            data-id="' . $data->id . '">Approve as Supervisor</a>
    //                                    </div>';

    //                     }
    //                 }
    //                     break;

    //                 case "DGA":
    //                     // Example for DGA
    //                     if($data->is_reject == 0){

    //                     if ($data->approve3 == 1) {
    //                         $button .= '<div class="text-center" style="display:inline">
    //                                         <button class="btn btn-success btn-approve"
    //                                                 style="font-size:smaller; font-weight:bold;"
    //                                                 disabled>Approved</button>
    //                                    </div>';
    //                     } else {
    //                         $button .= '<div class="text-center" style="display:inline">
    //                                         <a href="javascript:void(0)"
    //                                            class="btn btn-primary btn-approve"
    //                                            style="font-size:smaller; font-weight:bold;"
    //                                            data-id="' . $data->id . '">Approve as DGA</a>
    //                                    </div>';

    //                     }
    //                 }
    //                     case "Employee":
    //                         // Example for DGA


    //                     break;

    //                 default:
    //                     $button = '<div class="text-center">
    //                                     <span class="text-danger">No actions available</span>
    //                                </div>';
    //                     break;
    //             }

    //             $button .= '<div class="text-center" style="display:inline">
    //                 <button class="btn btn-primary btn-view"
    //                         style="font-size:smaller; font-weight:bold;"
    //                         data-id="' . $data->id . '"
    //                         data-toggle="modal"
    //                         data-target="#travelRequestModal">View</button>
    //            </div>';


    //            if($data->is_reject == 0 && $data->leave_status != 'complete'){
    //             $button .= '<a href="javascript:void(0)"
    //             class="btn btn-primary btn-reject"
    //             style="font-size:smaller; font-weight:bold;"
    //             data-id="' . $data->id . '">Reject</a>';
    //            }


    //             return $button;
    //         })
    //         ->make(true);
    //     }

    //     return view('admin.leaveRequest.list');

    // }


    public function leave_request(Request $request)
    {


        if (Auth::user()->role_name == "Admin") {

            $data = LeaveDetail::with(['user', 'approver1'])->get();
        } else {
            $data = LeaveDetail::with(['user', 'approver1'])->where('approver1', Auth::user()->id)->get();
        }

        // return $data;
        // die;

        if ($request->ajax()) {
            return DataTables::of($data)

                ->addColumn('type', function ($data) {
                    return $data->leave_type;
                })
                ->addColumn('from_date', function ($data) {
                    return $data->from_date;
                })
                ->addColumn('to_date', function ($data) {
                    return $data->to_date;
                })
                ->addColumn('status', function ($data) {
                    if ($data->is_reject == 1) {
                        return 'Reject';
                    } else {
                        if ($data->approver1 && is_null($data->approve1)) {
                            return 'Pending ';
                        } elseif ($data->approve1 == 1) {
                            return 'Approved';
                        }
                    }
                })
                ->addColumn("action", function ($data) {
                    $button = '';

                    if ($data->is_reject == 0) {
                        if ($data->approve1 == 1) {
                            $button .= '<div class="text-center" style="display:inline">
                                               <button class="btn btn-success btn-approve"
                                                       style="font-size:smaller; font-weight:bold;"
                                                       disabled>Approved</button>
                                          </div>';
                        } else {

                            if (Auth::user()->id == $data->approver1) {

                                $button .= '<div class="text-center" style="display:inline">
                                               <a href="javascript:void(0)"
                                                  class="btn btn-info btn-approve"
                                                  style="font-size:smaller; font-weight:bold;"
                                                  data-id="' . $data->id . '">Approve</a>
                                          </div>';

                            }
                        }
                    }

                    $button .= '<div class="text-center" style="display:inline">
                   <button class="btn btn-primary btn-view"
                           style="font-size:smaller; font-weight:bold;"
                           data-id="' . $data->id . '"
                           data-toggle="modal"
                           data-target="#travelRequestModal">View</button>
              </div>';

                    if ($data->is_reject == 0 && $data->leave_status != "complete") {

                        if (Auth::user()->id == $data->approver1) {

                            $button .= '<a href="javascript:void(0)"
               class="btn btn-primary btn-reject"
               style="font-size:smaller; font-weight:bold;"
               data-id="' . $data->id . '">Reject</a>';

                        }

                    }

                    return $button;
                })
                ->make(true);
        }

        return view('admin.leaveRequest.list');

    }



    // public function approveLeaveRequest(Request $request)
    // {
    //     $leaveRecord = LeaveDetail::find($request->id);


    //     if ($leaveRecord) {

    //         $current_user_role = Auth::user()->role_name;
    //         $role = $current_user_role;

    //         switch ($role) {
    //         case "HR":
    //             $leaveRecord->approve1 = 1;


    //             break;
    //         case "Direct superior":
    //             if((!empty($leaveRecord->approver1) && $leaveRecord->approve1 != 1)){
    //                 return response()->json(['error' => 'Approver1 has not approved this leave request']);
    //             }
    //             $leaveRecord->approve2 = 1; 

    //             break;
    //         case "DGA":
    //             if((!empty($leaveRecord->approver1) && $leaveRecord->approve1 != 1)){
    //                 return response()->json(['error' => 'Approver1 has not approved this leave request']);
    //             }elseif((!empty($leaveRecord->approver2) && $leaveRecord->approve2 != 1)){
    //                 return response()->json(['error' => 'Approver2 has not approved this leave request']);
    //             }

    //             $leaveRecord->approve3 = 1; 

    //             break;
    //         default:
    //             echo "sorry no role assigne, first assigne your role";
    //         }


    //         if (
    //             (!empty($leaveRecord->approver1) && empty($leaveRecord->approve1)) ||
    //             (!empty($leaveRecord->approver2) && empty($leaveRecord->approve2)) ||
    //             (!empty($leaveRecord->approver3) && empty($leaveRecord->approve3))
    //         ) {
    //             $leaveRecord->leave_status = 'inprogress';
    //         } else {
    //             $annual_year = Carbon::now()->year; 
    //             $employee_annual_leave = EmployeeAnnualLeave::where('year', $annual_year)->where('user_id', $leaveRecord->user_id)->first();
    //             $leave_type = $leaveRecord->leave_type;

    //             $leave_days = $leaveRecord->total_days; // Assuming the number of leave days applied is passed in the request


    //             switch ($leave_type) {

    //                 case 'Annual Leave':
    //                     $employee_annual_leave->annual_leave += $leave_days;
    //                     break;

    //                 case 'Work From Home':
    //                     $employee_annual_leave->work_from_home += $leave_days;
    //                     break;             

    //                 case 'Sick Leave':
    //                     $employee_annual_leave->sick_leave += $leave_days;
    //                     break;

    //                 case 'Comp Off':
    //                     $employee_annual_leave->comp_off += $leave_days;
    //                     break; 

    //                 case 'Loss Off Pay':
    //                     $employee_annual_leave->loss_of_pay += $leave_days;
    //                     break;      

    //                 default:
    //                     # code...
    //                     break;
    //             }

    //             $employee_annual_leave->save();
    //             $leaveRecord->leave_status = 'complete';
    //         }
    //         $leaveRecord->save();
    //         return response()->json(['success' =>  'Leave request approved successfully!']);
    //     }
    //     return response()->json(['error' => 'Leave record not found.']);
    // }

    // public function approveLeaveRequest(Request $request)
    // {
    //     $leaveRecord = LeaveDetail::find($request->id);


    //     if ($leaveRecord) {

    //         $current_user_role = Auth::user()->role_name;
    //         $role = $current_user_role;

    //         switch ($role) {
    //         case "HR":
    //             $leaveRecord->approve1 = 1;


    //             break;
    //         case "Direct superior":
    //             if((!empty($leaveRecord->approver1) && $leaveRecord->approve1 != 1)){
    //                 return response()->json(['error' => 'Approver1 has not approved this leave request']);
    //             }
    //             $leaveRecord->approve2 = 1;

    //             break;
    //         case "DGA":
    //             if((!empty($leaveRecord->approver1) && $leaveRecord->approve1 != 1)){
    //                 return response()->json(['error' => 'Approver1 has not approved this leave request']);
    //             }elseif((!empty($leaveRecord->approver2) && $leaveRecord->approve2 != 1)){
    //                 return response()->json(['error' => 'Approver2 has not approved this leave request']);
    //             }

    //             $leaveRecord->approve3 = 1;

    //             break;
    //         default:
    //             echo "sorry no role assigne, first assigne your role";
    //         }


    //         if (
    //             (!empty($leaveRecord->approver1) && empty($leaveRecord->approve1)) ||
    //             (!empty($leaveRecord->approver2) && empty($leaveRecord->approve2)) ||
    //             (!empty($leaveRecord->approver3) && empty($leaveRecord->approve3))
    //         ) {
    //             $leaveRecord->leave_status = 'inprogress';
    //         } else {
    //             $annual_year = Carbon::now()->year;
    //             $employee_annual_leave = EmployeeAnnualLeave::where('year', $annual_year)->where('user_id', $leaveRecord->user_id)->first();
    //             $leave_type = $leaveRecord->leave_type;

    //             $leave_days = $leaveRecord->total_days; // Assuming the number of leave days applied is passed in the request




    //             switch ($leave_type) {

    //                 case 'Annual Leave':
    //                     $employee_annual_leave->annual_leave += $leave_days;
    //                     $employee_annual_leave->total_annual_leave -= $leave_days;
    //                     break;

    //                 case 'Work From Home':
    //                     $employee_annual_leave->work_from_home += $leave_days;
    //                     $employee_annual_leave->total_wfh -= $leave_days;
    //                     break;            

    //                 case 'Sick Leave':
    //                     $employee_annual_leave->sick_leave += $leave_days;
    //                     $employee_annual_leave->total_sick_leave -= $leave_days;
    //                     break;

    //                 case 'Comp Off':
    //                     $employee_annual_leave->comp_off += $leave_days;
    //                     break;

    //                 case 'Loss Off Pay':
    //                     $employee_annual_leave->loss_of_pay += $leave_days;
    //                     break;      

    //                 default:
    //                     # code...
    //                     break;
    //             }

    //             $employee_annual_leave->save();
    //             $leaveRecord->leave_status = 'complete';
    //         }
    //         $leaveRecord->save();
    //         return response()->json(['success' =>  'Leave request approved successfully!']);
    //     }
    //     return response()->json(['error' => 'Leave record not found.']);
    // }


    public function approveLeaveRequest(Request $request)
    {
        $leaveRecord = LeaveDetail::find($request->id);

        if ($leaveRecord) {

            $leaveRecord->approve1 = 1;

            $annual_year = Carbon::now()->year;
            $employee_annual_leave = EmployeeAnnualLeave::where('year', $annual_year)->where('user_id', $leaveRecord->user_id)->first();
            $leave_type = $leaveRecord->leave_type;

            $leave_days = $leaveRecord->total_days; // Assuming the number of leave days applied is passed in the request

            switch ($leave_type) {

                case 'Annual Leave':
                    $employee_annual_leave->annual_leave += $leave_days;
                    $employee_annual_leave->total_annual_leave -= $leave_days;
                    break;

                case 'Work From Home':
                    $employee_annual_leave->work_from_home += $leave_days;
                    $employee_annual_leave->total_wfh -= $leave_days;
                    break;

                case 'Sick Leave':
                    $employee_annual_leave->sick_leave += $leave_days;
                    $employee_annual_leave->total_sick_leave -= $leave_days;
                    break;

                case 'Comp Off':
                    $employee_annual_leave->comp_off += $leave_days;
                    break;

                case 'Loss Off Pay':
                    $employee_annual_leave->loss_of_pay += $leave_days;
                    break;

                default:
                    # code...
                    break;
            }

            $employee_annual_leave->save();
            $leaveRecord->leave_status = 'complete';

            $leaveRecord->save();
            return response()->json(['success' => 'Leave request approved successfully!']);
        }
        return response()->json(['error' => 'Leave record not found.']);
    }



    public function getLeaveRequestDetails($id)
    {
        $leaveRequest = LeaveDetail::with(['user', 'approver1', 'approver2', 'approver3'])->find($id); // Fetch the travel request by ID

        if ($leaveRequest) {
            return response()->json($leaveRequest);
        } else {
            return response()->json(['message' => 'Leave Request not found'], 404);
        }
    }

    public function rejectLeaveRequest(Request $request)
    {
        $annual_year = Carbon::now()->year;

        $leave_request = LeaveDetail::find($request->id);
        $leave_request->who_reject = Auth::id();
        $leave_request->is_reject = 1;
        $leave_request->leave_status = 'reject';
        $leave_request->reject_reason = $request->reason;
        if ($leave_request->save()) {
            // $employee_annual_leave = EmployeeAnnualLeave::where('year', $annual_year)->where('user_id', $leave_request->user_id)->first();

            // switch ($leave_request->leave_type) {

            //     case 'Annual Leave':
            //         $employee_annual_leave->annual_leave -= $leave_request->total_days;
            //         break;

            //     case 'Work From Home':
            //         $employee_annual_leave->work_from_home -= $leave_request->total_days;

            //         break;             

            //     case 'Sick Leave':
            //         $employee_annual_leave->sick_leave -= $leave_request->total_days;
            //         break;

            //     case 'Comp Off':
            //         $employee_annual_leave->comp_off -= $leave_request->total_days;
            //         break; 

            //     case 'Loss Off Pay':
            //         $employee_annual_leave->loss_of_pay -= $leave_request->total_days;
            //         break;      

            //     default:
            //         # code...
            //         break;
            // }
            // $employee_annual_leave->save();
            return response()->json(['success' => 'Leave request rejected successfully!']);
        } else {
            return response()->json(['error' => 'Something Went Wrong']);

        }
    }

    public function guestLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();
        return $user;
        die;

        if (Auth::attempt(['email' => $request->email, 'password' => $user->password, 'status' => 'Active'])) {
            return response()->json(['message' => 'Login successful', 'user' => 'current user'], 200);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }


    public function loan_request(Request $request)
    {

        $current_user_role = Auth::user()->role_name;
        $role = $current_user_role;

        switch ($role) {
            case "HR":
                $data = EmployeeLoans::with([
                    'loan' => function ($query) {
                        return $query->select('id', 'name');
                    },
                    'currency' => function ($q) {
                        return $q->select('id', 'code');
                    },
                    'employee' => function ($qu) {
                        return $qu->select('id', 'name');
                    }
                ])->where('approver1', Auth::user()->id)->get();
                break;
            case "Direct superior":
                $data = EmployeeLoans::with([
                    'loan' => function ($query) {
                        return $query->select('id', 'name');
                    },
                    'currency' => function ($q) {
                        return $q->select('id', 'code');
                    },
                    'employee' => function ($qu) {
                        return $qu->select('id', 'name');
                    }
                ])->where('approver2', Auth::user()->id)->get();
                break;
            case "DGA":
                $data = EmployeeLoans::with([
                    'loan' => function ($query) {
                        return $query->select('id', 'name');
                    },
                    'currency' => function ($q) {
                        return $q->select('id', 'code');
                    },
                    'employee' => function ($qu) {
                        return $qu->select('id', 'name');
                    }
                ])->where('approver3', Auth::user()->id)->get();
                break;
            default:
                echo "sorry no role assigne, first assigne your role";
        }


        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('employee_name', function ($data) {
                    return $data->employee->name;
                })
                ->addColumn('loan_type', function ($data) {
                    return $data->loan->name;
                })
                ->addColumn('currency', function ($data) {
                    return $data->currency->code;
                })
                ->addColumn('start_date', function ($data) {
                    return $data->start_date;
                })
                ->addColumn('loan_period', function ($data) {
                    return $data->period_months;
                })
                ->addColumn('loan_amount', function ($data) {
                    return $data->amount;
                })
                ->addColumn('monthly_installment', function ($data) {
                    return $data->monthly_installment;
                })
                ->addColumn('Status', function ($data) {
                    if ($data->is_reject == 1) {
                        return 'Reject';
                    } else {
                        if ($data->approver1 && is_null($data->approve1)) {
                            return 'Pending (Awaiting Reporting Manager)';
                        } elseif ($data->approver2 && is_null($data->approve2)) {
                            return 'Pending (Awaiting Approver 2)';
                        } elseif ($data->approver3 && is_null($data->approve3)) {
                            return 'Pending (Awaiting Approver 3)';
                        } elseif ($data->approve1 == 1 && $data->approve2 == 1 && $data->approve3 == 1) {
                            return 'Approved';
                        } else {
                            return 'Approved';
                        }
                    }
                })
                ->addColumn("action", function ($data) {
                    $current_user_role = Auth::user()->role_name; // Get the current user's role
                    $button = '';
                    switch ($current_user_role) {
                        case "HR":
                            if ($data->is_reject == 0) {
                                if ($data->approve1 == 1) {
                                    $button .= '<div class="text-center" style="display:inline">
                                                <button class="btn btn-success btn-approve" 
                                                        style="font-size:smaller; font-weight:bold;" 
                                                        disabled>Approved</button>
                                           </div>';
                                } else {

                                    $button .= '<div class="text-center" style="display:inline">
                                                <a href="javascript:void(0)" 
                                                   class="btn btn-info btn-approve"
                                                   style="font-size:smaller; font-weight:bold;" 
                                                   data-id="' . $data->id . '">Approve As Reporting Manager</a>
                                           </div>';

                                }
                            }

                            break;

                        case "Direct superior":
                            // Example for Direct superior
                            if ($data->is_reject == 0) {

                                if ($data->approve2 == 1) {
                                    $button .= '<div class="text-center" style="display:inline">
                                            <button class="btn btn-success btn-approve" 
                                                    style="font-size:smaller; font-weight:bold;" 
                                                    disabled>Approved</button>
                                       </div>';
                                } else {
                                    $button .= '<div class="text-center" style="display:inline">
                                            <a href="javascript:void(0)" 
                                               class="btn btn-warning btn-approve"
                                               style="font-size:smaller; font-weight:bold;" 
                                               data-id="' . $data->id . '">Approve as Supervisor</a>
                                       </div>';

                                }
                            }
                            break;

                        case "DGA":
                            // Example for DGA
                            if ($data->is_reject == 0) {

                                if ($data->approve3 == 1) {
                                    $button .= '<div class="text-center" style="display:inline">
                                            <button class="btn btn-success btn-approve" 
                                                    style="font-size:smaller; font-weight:bold;" 
                                                    disabled>Approved</button>
                                       </div>';
                                } else {
                                    $button .= '<div class="text-center" style="display:inline">
                                            <a href="javascript:void(0)" 
                                               class="btn btn-primary btn-approve"
                                               style="font-size:smaller; font-weight:bold;" 
                                               data-id="' . $data->id . '">Approve as DGA</a>
                                       </div>';

                                }
                            }
                        case "Employee":
                            // Example for DGA 
                            break;

                        default:
                            $button = '<div class="text-center">
                                        <span class="text-danger">No actions available</span>
                                   </div>';
                            break;
                    }

                    $button .= '<div class="text-center" style="display:inline">
                    <button class="btn btn-secondary btn-view" 
                            style="font-size:smaller; font-weight:bold;" 
                            data-id="' . $data->id . '" 
                            data-toggle="modal" 
                            data-target="#travelRequestModal"><i class="fa fa-eye" aria-hidden="true"></i></button>
               </div>';
                    if ($data->is_reject == 0) {
                        $button .= '<a href="javascript:void(0)" 
                class="btn btn-primary btn-reject"
                style="font-size:smaller; font-weight:bold;" 
                data-id="' . $data->id . '">Reject</a>';
                    }


                    return $button;
                })
                ->make(true);
        }

        return view('admin.loanRequest.list');

    }

    public function approveLoanRequest(Request $request)
    {
        $loanRecord = EmployeeLoans::find($request->id);

        if ($loanRecord) {

            $current_user_role = Auth::user()->role_name;
            $role = $current_user_role;

            switch ($role) {
                case "HR":
                    $loanRecord->approve1 = 1;


                    break;
                case "Direct superior":
                    if ((!empty($loanRecord->approver1) && $loanRecord->approve1 != 1)) {
                        return response()->json(['error' => 'Approver1 has not approved this loan request']);
                    }
                    $loanRecord->approve2 = 1;

                    break;
                case "DGA":
                    if ((!empty($loanRecord->approver1) && $loanRecord->approve1 != 1)) {
                        return response()->json(['error' => 'Approver1 has not approved this loan request']);
                    } elseif ((!empty($loanRecord->approver2) && $loanRecord->approve2 != 1)) {
                        return response()->json(['error' => 'Approver2 has not approved this loan request']);
                    }

                    $loanRecord->approve3 = 1;

                    break;
                default:
                    echo "sorry no role assigne, first assigne your role";
            }
            $loanRecord->save();
            return response()->json(['success' => 'Loan request approved successfully!']);
        }
        return response()->json(['error' => 'Loan record not found.']);
    }

    public function rejectLoanRequest(Request $request)
    {

        $leave_request = EmployeeLoans::find($request->id);
        $leave_request->who_reject = Auth::id();
        $leave_request->is_reject = 1;
        $leave_request->reject_reason = $request->reason;
        if ($leave_request->save()) {
            return response()->json(['success' => 'Loan request rejected successfully!']);
        } else {
            return response()->json(['error' => 'Something Went Wrong']);

        }
    }

    public function getLoanRequestDetails($id)
    {
        $leaveRequest = EmployeeLoans::with(['loan', 'user', 'approver1', 'approver2', 'approver3'])->find($id); // Fetch the travel request by ID

        if ($leaveRequest) {
            return response()->json($leaveRequest);
        } else {
            return response()->json(['message' => 'Leave Request not found'], 404);
        }
    }



}
