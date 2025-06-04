<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnnualLeave;
use App\Models\Employee;
use App\Models\EmployeeAnnualLeave;
use App\Models\LeaveDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class LeaveManagement extends Controller
{
    


    public function indexnew(Request $request){

    

    if (auth()->user()->role_name == 'HR') {
        $hr = User::where('role_name', 'HR')->where('id', '!=', auth()->id())->get(['id', 'name']);
    } else {
        $hr = User::where('role_name', 'HR')->get(['id', 'name']);
    }
    
    if (auth()->user()->role_name == 'Direct superior') {
        $direct_superior = User::where('role_name', 'Direct superior')->where('id', '!=', auth()->id())->get(['id', 'name']);
    } else {
        $direct_superior = User::where('role_name', 'Direct superior')->get(['id', 'name']);
    }

    if (auth()->user()->role_name == 'DGA') {
        $dga = User::where('role_name', 'DGA')->where('id', '!=', auth()->id())->get(['id', 'name']);
    } else {
        $dga = User::where('role_name', 'DGA')->get(['id', 'name']);
    }
           

    $data = LeaveDetail::where('user_id', Auth::id())->get();

    if ($request->ajax()) {
        return DataTables::of($data)
        ->addColumn('leave_type', function ($data) {
            return $data->leave_type;
        })
        ->addColumn('leave_status', function ($data) {
            if($data->is_reject == 0){
                if ($data->approver1 && is_null($data->approve1)) {
                    return 'Pending';
                } elseif ($data->approve1 == 1) {
                    return 'Approved';
                }
            }else{
                return 'Rejected';
            }
        })

        ->addColumn("action", function ($data) {
            // $button = '<div style="display:flex;">
            //     <a href="javascript:void(0)"
            //        class="btn btn-info mr-1 btn-edit"
            //        style="font-size:smaller; font-weight:bold;"
            //        data-id="' . $data->id . '">Edit</a>
              
            //      <button class="btn btn-primary btn-view" 
            //             style="font-size:smaller; font-weight:bold;" 
            //             data-id="' . $data->id . '" 
            //             data-toggle="modal" 
            //             data-target="#travelRequestModal">View</button>   
            // </div>';
            $button = '<button class="btn btn-primary btn-view" 
                        style="font-size:smaller; font-weight:bold;" 
                        data-id="' . $data->id . '" 
                        data-toggle="modal" 
                        data-target="#travelRequestModal"><i class="fa fa-eye" aria-hidden="true"></i></button>   
            </div>';
            return $button;
        })
            ->make(true);
    }

        $authuser = Auth::User();

        $employeeDetails = Employee :: where('employee_id',  $authuser->id)->with(['approver1User'=>function($approver1){
            return $approver1->select('id', 'name');
        },'approver2User'=>function($approver2){
            return $approver2->select('id', 'name');
        }, 'approver3User'=>function($approver3){
            return $approver3->select('id', 'name');
        }])->first();

        
    return view('admin.leave.listnew',['employeeDetails' => $employeeDetails,'hr'=> $hr, 'direct_superior' => $direct_superior, 'dga' => $dga]);

    }



    public function save(Request $request){
 
 
        if($request->for_employee == 'true'){
            $employee_for = 'true';
            $employee_object = json_decode($request->employee_object , true);
            $user_id = $employee_object['id'];
        }else{
            $employee_for = 'false';
            $user_id = Auth::user()->id;
        }
 
        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date);
 
 
         // Check if the user already has a leave within the given date range
        $existing_leave = LeaveDetail::where('user_id', $user_id)
        ->where(function($query) use ($fromDate, $toDate) {
            $query->whereBetween('from_date', [$fromDate, $toDate])
                ->orWhereBetween('to_date', [$fromDate, $toDate])
                ->orWhere(function($query) use ($fromDate, $toDate) {
                    $query->where('from_date', '<=', $fromDate)
                            ->where('to_date', '>=', $toDate);
                });
        })
        ->exists();
 
        if ($existing_leave) {
            $res['message'] = 'failed';
            $res['msg'] = 'You have already applied for leave during this period.';
            return response( $res );
        }
       
       
        $daysDifference = $fromDate->diffInDays($toDate);
        $daysDifference++;
        $days = $request->to_date == null ? 1 : $daysDifference;
 
        $annual_year = Carbon::now()->year;
        $annual_leaves = AnnualLeave::where('year', $annual_year)->first();
        $employee_annual_leave = EmployeeAnnualLeave::where('year', $annual_year)->where('user_id', $user_id)->first();
        $leave_type = $request->leave_type;
 
        $leave_days = $days; // Assuming the number of leave days applied is passed in the request
       
        $status = 'pending';
        switch ($leave_type) {
            case 'Annual Leave':
                $day = $annual_leaves->annual_leave - $employee_annual_leave->annual_leave;
                $case = 'Annual Leave';
                $employee_annual_leave->annual_leave += $leave_days;
                break;
               
            case 'Work From Home':
                $day = $annual_leaves->work_from_home - $employee_annual_leave->work_from_home;
                $case = 'Work From Home';
                $employee_annual_leave->work_from_home += $leave_days;
 
                break;            
               
            case 'Sick Leave':
                $day = $annual_leaves->sick_leave - $employee_annual_leave->sick_leave;
                $case = 'Sick Leave';
                $employee_annual_leave->sick_leave += $leave_days;
                break;
 
            case 'Comp Off':
                $day = 1000;
                $employee_annual_leave->comp_off += $leave_days;
                break;
 
            case 'Loss Off Pay':
                $day = 1000;
                $employee_annual_leave->loss_of_pay += $leave_days;
                break;      
       
            default:
                # code...
                break;
        }
 
       
        if($days > $day){
            $msg = 'You have ' . $day . ' ' . $case . ' left.';
            $res['message'] = 'failed';
            $res['msg'] = $msg;
            return response( $res );
        }
       
        $leave_detail = new LeaveDetail();
        $leave_detail->user_id = $user_id;
        $leave_detail->employee_for = $employee_for;
        $leave_detail->leave_type = $request->leave_type;
        $leave_detail->from_date = $request->from_date;
        $leave_detail->to_date = $request->to_date;
        $leave_detail->total_days = $days;
        $leave_detail->contact_number = $request->contact_number;
        $leave_detail->user_reason = $request->user_reason;
        $leave_detail->approver1 = $request->input('first_level_approver_id') == "null" ? null : $request->input('first_level_approver_id') ;
        //sarthak start
        // $leave_detail->approver2 = $request->input('second_level_approver_id') == "null" ? null : $request->input('second_level_approver_id');
        // $leave_detail->approver3 = $request->input('third_level_approver_id') == "null" ? null : $request->input('third_level_approver_id');
        //sarthak end
        $leave_detail->approve1 = $request->approve1;
        $leave_detail->approve2 = $request->approve2;
        $leave_detail->approve3 = $request->approve3;
        $leave_detail->leave_status = $status;
 
        $leave_detail->created_at = now();
        $leave_detail->updated_at = now();
 
        if($leave_detail->save()){
            // return response()->json(['result' => 'success', 'message' => 'Hurrayy, leave has been successfully applied']);
            $res['message'] = 'success';
            $res['msg'] = 'Hurrayy, leave has been successfully applied';
            return response( $res );
        }else{
            // return response()->json(['result' => 'error', 'message' => 'Something Went Wrong']);
            $res['message'] = 'failed';
            $res['msg'] = 'Something Went Wrong';
            return response( $res );
        }
   
    }
 


    public function restrictLeave(Request $request){



        if($request->for_employee == 'true'){
            $employee_for = 'true';
            $employee_object = json_decode($request->employee_object , true);
            $user_id = $employee_object['id'];
        }else{
            $employee_for = 'false';
            $user_id = Auth::user()->id;
        }

        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date);


        //  // Check if the user already has a leave within the given date range
        // $existing_leave = LeaveDetail::where('user_id', $user_id)
        // ->where(function($query) use ($fromDate, $toDate) {
        //     $query->whereBetween('from_date', [$fromDate, $toDate])
        //         ->orWhereBetween('to_date', [$fromDate, $toDate])
        //         ->orWhere(function($query) use ($fromDate, $toDate) {
        //             $query->where('from_date', '<=', $fromDate)
        //                     ->where('to_date', '>=', $toDate);
        //         });
        // })
        // ->exists();

        // if ($existing_leave) {
        //     $res['message'] = 'failed';
        //     $res['msg'] = 'You have already applied for leave during this period.';
        //     return response( $res );
        // }
        
        
        $daysDifference = $fromDate->diffInDays($toDate);
        $daysDifference++;
        $days = $request->to_date == null ? 1 : $daysDifference;


        $annual_year = Carbon::now()->year; 
        $annual_leaves = AnnualLeave::where('year', $annual_year)->first();
        $employee_annual_leave = EmployeeAnnualLeave::where('year', $annual_year)->where('user_id', $user_id)->first();
        $leave_type = $request->leave_type;

        $leave_days = $days; // Assuming the number of leave days applied is passed in the request

        
        
        switch ($leave_type) {
            case 'Restrict Leave':
                $day = $employee_annual_leave->restrict_leave;
                $case = 'Restrict Leave';
                $employee_annual_leave->restrict_leave = $employee_annual_leave->restrict_leave - 1;
                break;
                
        
            default:
                # code...
                break;
        }

        if($days > $day){

            $msg = 'You have ' . $day . ' ' . $case . ' left.';
            $res['message'] = false;
            $res['msg'] = $msg;
            return response( $res );
        }
        $employee_annual_leave->save();
        $leave_detail = new LeaveDetail();
        $leave_detail->user_id = $user_id;
        $leave_detail->employee_for = $employee_for;
        $leave_detail->leave_type = $request->leave_type;
        $leave_detail->restrict_leave_id = $request->holiday_id;
        $leave_detail->from_date = $request->from_date;
        $leave_detail->to_date = $request->to_date;
        $leave_detail->total_days = $days;
        $leave_detail->contact_number = null;
        $leave_detail->user_reason = $request->user_reason;
        $leave_detail->approver1 = null ;
        $leave_detail->approver2 = null ;
        $leave_detail->approver3 = null ;
        $leave_detail->approve1 =  null;
        $leave_detail->approve2 =  null;
        $leave_detail->approve3 =  null;
        $leave_detail->leave_status = 'complete';

        $leave_detail->created_at = now();
        $leave_detail->updated_at = now();

        if($leave_detail->save()){
            // return response()->json(['result' => 'success', 'message' => 'Hurrayy, leave has been successfully applied']);
            $res['message'] = 'success';
            $res['msg'] = 'Hurrayy, leave has been successfully applied';
            return response( $res );
        }else{
            // return response()->json(['result' => 'error', 'message' => 'Something Went Wrong']);
            $res['message'] = 'failed';
            $res['msg'] = 'Something Went Wrong';
            return response( $res );
        }
    
    }



    public function viewHistory(Request $request){
        $data['leave_history'] = LeaveDetail::with(['approver1', 'approver2', 'approver3'])->where('user_id', Auth::id())->paginate(10);
        return view('admin.leave.history', $data);
    }

    public function filteredLeaveHistory(Request $request){
 
        $fromDate = Carbon::parse($request->input('from_date'))->format('Y-m-d');
        $toDate = Carbon::parse($request->input('to_date'))->format('Y-m-d');
            $data['leave_history'] = LeaveDetail::with(['approver1', 'approver2', 'approver3'])
                ->where('user_id', Auth::id())
            ->where(function($query) use ($fromDate, $toDate) {
                $query->whereBetween('from_date', [$fromDate, $toDate])
                    ->orWhereBetween('to_date', [$fromDate, $toDate]);
            })->get();
 

            if(isset($data['leave_history'])){
                return response()->json([
                    'status'=>true,
                    'data'=>$data
                ]);
            }
            else{
                return response()->json([
                    'status'=>false,
                    'message'=>'No Record Found'
                ]);
                
            }
    }

    public function leaveBalance(Request $request){
        $year = Carbon::now()->year; 
        $annual_leaves = AnnualLeave::where('year', $year)->first();
        $employee_leaves = EmployeeAnnualLeave::where('year', $year)->where('user_id', Auth::id())->first();
        return view('admin.employee.leavebalace', compact('employee_leaves', 'annual_leaves'));
    }


     
    public function leaveRequestStatus(Request $request){

        $date = null;
        if($request->from  == 'dashboard'){
          $date = Carbon::now()->format('Y-m-d');
        }
                  
          if ($request->ajax()) {
   
            if($request->date != null){
            $date = Carbon::now()->format('Y-m-d');
            $data = LeaveDetail::whereDate('from_date', '<=', $date) ->whereDate('to_date', '>=', $date)->where('leave_status',$request->status)->select('leave_type', 'from_date', 'to_date','leave_status')->get();
            }else{
              $data = LeaveDetail::where('leave_status',$request->status)->select('leave_type', 'from_date', 'to_date','leave_status')->get(); //->where('leave_status',$request->status)
            }

   
              return DataTables::of($data)
              ->addIndexColumn()
              ->addColumn('leave_type', function ($data) {
                  return $data->leave_type;
              })
              ->addColumn('from_date', function ($data) {
                         
                  $fromDate=Carbon::parse($data->from_date)->format('d/m/Y');
   
                  return $fromDate;
              }) ->addColumn('to_date', function ($data) {
                  $toDate=Carbon::parse($data->to_date)->format('d/m/Y');
   
                  return $toDate;
              }) ->addColumn('leave_status', function ($data) {
                   if($data->leave_status === 'pending'){
                      return '<span class="badge bg-secondary">Pending</span>';
                   }
   
                   else if($data->leave_status === 'reject'){
                      return '<span class="badge bg-inverse-danger">reject</span>';
   
                   }
   
                   else if($data->leave_status === 'complete'){
                      return '<span class="badge bg-inverse-success">Complete</span>';
   
                   }
                   else if($data->leave_status === 'inprogress'){
                    return '<span class="badge bg-warning text-dark">In Progress</span>';
                 }
                //  return $data->leave_status;
              }) ->rawColumns(['leave_status'])->make(true);
         
   
          }
          $leave_status = $request->status;
   
          return view('admin.leave.leave_status',compact('leave_status', 'date') );
   
   
      }

    public function leaveTypeDetails(Request $request){

       $year = Carbon::now()->year;
       $type = $request->type;
       $leave_type = "";

        switch ($type) {
            case 'work_from_home':
                $leave_type = 'Work From Home';
                break;
            case 'annual_leave':
                $leave_type = 'Annual Leave';
                break;
            case 'sick_leave':
                $leave_type = 'Sick Leave';
                break;    
            default:
                # code...
                break;
        }
        // Get data from the database
        $leaveData = DB::table('leave_details')
        ->select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_days) as total_leaves')
        )
        ->where('leave_type', $leave_type)
        ->where('leave_status', 'complete')
        ->whereYear('created_at', $year)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->pluck('total_leaves', 'month');

        // Default array with 0 for all months
        $formattedData = array_fill(1, 12, 0);

        // Replace with actual values from database
        foreach ($leaveData as $month => $total_leaves) {
            $formattedData[$month] = (int)$total_leaves;
        }

       
       return view('admin.leave.leave_type_detail', compact('formattedData', 'leave_type','year'));
    }
 



}
