<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CurrencyTypes;
use App\Models\Employee;
use App\Models\TravelCategoryAllowance;
use App\Models\TravelRecords;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PharIo\Manifest\Author;
use Yajra\DataTables\Facades\DataTables;



class TravelRecordController extends Controller
{
    
    public function list(Request $request)
    {
        if(Auth::user()->role_name == "Admin"){
            $data = TravelRecords::get();
        }else{
            $data = TravelRecords::where('employee_id', Auth::id())->get();
        }
        if ($request->ajax()) {
            return DataTables::of($data)
            ->addColumn('type', function ($data) {
                return $data->type;
            })
            ->addColumn('purpose', function ($data) {
                return $data->purpose;
            })
            ->addColumn('travel_from', function ($data) {
                return $data->travel_from;
            })
            ->addColumn('travel_to', function ($data) {
                return $data->travel_to;
            })
            ->addColumn('travel_date', function ($data) {
                return $data->travel_date;
            })
            ->addColumn('return_date', function ($data) {
                return $data->return_date;
            })
            ->addColumn('request_status', function ($data) {
                if (!empty($data->status)) {
                    if ($data->status === 'reject') {
                        return '<span class="badge bg-inverse-danger">Reject</span>';
                    } elseif ($data->status === 'complete') {
                        return '<span class="badge bg-inverse-success">Complete</span>';
                    }elseif ($data->status === 'pending') {
                        return '<span class="badge bg-inverse-primary">Pending</span>';
                    }elseif ($data->status === 'inprogress') {
                        return '<span class="badge bg-inverse-warning">Inprogress</span>';
                    }
                }
                return '<span class="badge bg-secondary">Unknown</span>'; // Fallback for unknown status
            })


 
            ->addColumn("action", function ($data) {
                $button = '<div style="display:flex;">
                    <a href="javascript:void(0)"
                       class="btn btn-info mr-1 btn-edit"
                       style="font-size:smaller; font-weight:bold;"
                       onclick="app.editTravelRequest('.htmlspecialchars(json_encode($data)).')"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="javascript:void(0)"
                       class="btn btn-primary mr-1 btn-delete"
                       style="font-size:smaller; font-weight:bold;"
                       data-id="' . $data->id . '"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    <a class="btn btn-primary btn-view" 
                        style="font-size:smaller; font-weight:bold;" 
                        data-id="' . $data->id . '" 
                        data-toggle="modal" 
                        data-target="#travelRequestModal"><i class="fa fa-eye" aria-hidden="true"></i></a>
                </div>';
                return $button;
            })
            ->rawColumns(['request_status', 'action']) // Render badges properly
            ->make(true);
        }
        $currencies = CurrencyTypes::select('id','code')->get();


        $authuser = Auth::User();

        

        $employeeDetails = Employee::where('employee_id',  $authuser->id)->with(['approver1User'=>function($approver1){
            return $approver1->select('id');
        },'approver2User'=>function($approver2){
            return $approver2->select('id');
        }, 'approver3User'=>function($approver3){
            return $approver3->select('id');
        },
        'user' => function($user){
            return $user->select('id', 'name');
        }
        ])->first();


      

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
        
       
            $travel_allowance = TravelCategoryAllowance::with('travel_allowance')->where('division_id', $employeeDetails['division_id'])
            ->where('category_id', $employeeDetails['category_id'])->get();
       
        return view('admin.travelRecords.list',['travel_allowance'=> $travel_allowance, 'employeeDetails' => $employeeDetails,'currencies'=>$currencies, 'hr'=> $hr, 'direct_superior' => $direct_superior, 'dga' => $dga]);
    }

    public function store(Request $request)
    {
       if($request->for_employee == 'true'){
        $employee_for = 'true';
        $employee_object = json_decode($request->employee_object , true);
        $user_id = $employee_object['id'];
       }else{
        $employee_for = 'false';
        $user_id = Auth::user()->id;
       }
        // try {
        
            $employee_id         = $user_id;
            $type         = $request->input('transportation');
            $purpose             = $request->input('purpose');
            $travel_from             = $request->input('travel_from');
            $travel_to            = $request->input('travel_to');
            $travel_date       = $request->input('travel_date') == "null" ? null : $request->input('travel_date') ;
            $return_date           = $request->input('return_date');
            $notes        = $request->input('notes');
            $currency_id               = $request->input('currency_id') == "null" ? null : $request->input('currency_id');
            $total_funding_proposed  = $request->input('total_funding_proposed') == "null" ? null : $request->input('total_funding_proposed');
            $first_level_approver_id  = $request->input('first_level_approver_id') == "null" ? null : $request->input('first_level_approver_id') ;
            $second_level_approver_id  = $request->input('second_level_approver_id') == "null" ? null : $request->input('second_level_approver_id');
            $third_level_approver_id  = $request->input('third_level_approver_id') == "null" ? null : $request->input('third_level_approver_id');


                // if ($request->hasFile('attachment')) {
                //     $attachment = $request->file('attachment');
                //     $filename = time() . '_' . $attachment->getClientOriginalName();
                //     $attachment->move(public_path('attachments'), $filename);
        
                //     $data['attachment'] = $filename;
                // }
                $travel_records = new TravelRecords();
                $travel_records->for_employee = $employee_for;
                $travel_records->employee_id = $employee_id;
                $travel_records->type = $type;
                $travel_records->purpose = $purpose;
                $travel_records->travel_from = $travel_from;
                $travel_records->travel_to =  $travel_to;
                $travel_records->travel_date =  $travel_date;
                $travel_records->return_date =  $return_date;
                $travel_records->notes = $notes;
                $travel_records->currency_id = $currency_id;
                $travel_records->funding = $total_funding_proposed;
                $travel_records->approver1 = $first_level_approver_id;
                $travel_records->approver2 = $second_level_approver_id;
                $travel_records->approver3 = $third_level_approver_id;
                $travel_records->created_at = now();
                $travel_records->updated_at = now();
                if($travel_records->save()){
                    $res['message'] = 'success';
                }else{
                 $res['message'] = 'failed';
                } 
                return response( $res );

        // }
        //  catch (\Exception $e) {
        //     app(\App\Exceptions\Handler::class)->report($e);
    
        //     return response()->json([
        //         'result' => 'failure',
        //         'msg' => 'An error occurred. Please try again.',
        //     ]);
        // }
    }
    public function edit($id)
    {
        $travel = TravelRecords::findOrFail($id);
        $travel->attachment = url('attachments/' . $travel->attachment);
        return response()->json($travel);
    }
    public function update(Request $request)
    {
       $travel_id = $request->travel_id;
        if($request->employee_id){
            $user_id = $request->employee_id;
        }else{
            $user_id = Auth::user()->id;
        }

        try {
            
            $travel = TravelRecords::findOrFail($travel_id);
            if ($request->hasFile('attachment')) {
                if ($travel->attachment && file_exists(public_path('attachments/' . $travel->attachment))) {
                    unlink(public_path('attachments/' . $travel->attachment));
                }

                $file = $request->file('attachment');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('attachments'), $filename);

                $travel->attachment = $filename;
            }

            $update_data = $travel->update([
                'type' => $request->input('transportation'),
                'purpose' => $request->input('purpose'),
                'travel_from' => $request->input('travel_from'),
                'travel_to' => $request->input('travel_to'),
                'travel_date' => $request->input('travel_date'),
                'return_date' => $request->input('return_date'),
                'funding' => $request->input('total_funding_proposed'),
                'currency_id' => $request->input('currency_id'),
                'notes' => $request->input('notes'),
                'employee_id' => $user_id
            ]);

            if($update_data){
                $res['message'] = 'success';
            }else{
             $res['message'] = 'failed';
            } 
            return response( $res );

        } catch (\Exception $e) {
            app(\App\Exceptions\Handler::class)->report($e);
    
            return response()->json([
                'result' => 'failure',
                'msg' => 'An error occurred. Please try again.',
            ]);
        }
    }
    public function delete($id)
    {
        try {
            $travel = TravelRecords::findOrFail($id);
            if ($travel->attachment && file_exists(public_path('attachments/' . $travel->attachment))) {
                unlink(public_path('attachments/' . $travel->attachment));
            }
            $travel->delete();
            return response()->json([
                'result' => 'success',
                'msg' => 'Travel Request deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Failed to delete Travel Request.',
            ]);
        }
    }

    public function subOrdinateList(Request $request)
    {
        $employeeId = $request->employee_id;
        $data = TravelRecords::with('employee')
        ->when($employeeId, function ($query) use ($employeeId) {
            return $query->where('employee_id', $employeeId);
        })
        ->get();


        if ($request->ajax()) {
            return DataTables::of($data)
            ->addColumn('employee_id', function ($data) {
                return $data->employee->name;
            })
            ->addColumn('type', function ($data) {
                return $data->type;
            })
            ->addColumn('purpose', function ($data) {
                return $data->purpose;
            })
            ->addColumn('travel_from', function ($data) {
                return $data->travel_from;
            })
            ->addColumn('travel_to', function ($data) {
                return $data->travel_to;
            })
            ->addColumn('travel_date', function ($data) {
                return $data->travel_date;
            })
            ->addColumn('status', function ($data) {
                return $data->status;
            })
 
            // ->addColumn("action", function ($data) {
            //     $button = '<div style="display:flex;">
            //         <a href="javascript:void(0)"
            //            class="btn btn-info mr-1 btn-edit"
            //            style="font-size:smaller; font-weight:bold;"
            //            data-id="' . $data->id . '">Edit</a>
            //     </div>';
            //     return $button;
            // })
                ->make(true);
        }
        $currencies = CurrencyTypes::select('id','code')->get();
        $employees = User::select('id','name')->get();
        return view('admin.travelRecords.subOrdinateList',['currencies'=>$currencies,'employees'=>$employees]);
    }

    public function travelRequestStatus(Request $request){

        $date = null;
        if($request->from  == 'dashboard'){
          $date = Carbon::now()->format('Y-m-d');
        }
   
        if ($request->ajax()) {

            if($request->date != null){
            $date = Carbon::now()->format('Y-m-d');
            $data = TravelRecords::whereDate('travel_date', '<=', $date) ->whereDate('return_date', '>=', $date)->where('status',$request->status)->select('type', 'travel_from', 'travel_to','status')->get();
            }else{
            $data = TravelRecords::where('status',$request->status)->select('type', 'travel_from', 'travel_to','status')->get();
            }
 
       
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('type', function ($data) {
                return $data->type;
            })
            ->addColumn('travel_from', function ($data) {
                return $data->travel_from;
            }) ->addColumn('travel_to', function ($data) {
                return $data->travel_to;
            }) ->addColumn('status', function ($data) {
                if($data->status === 'pending'){
                    return '<span class="badge bg-secondary">Pending</span>';
                 }
 
                 else if($data->status === 'reject'){
                    return '<span class="badge bg-inverse-danger">reject</span>';
 
                 }
 
                 else if($data->status === 'complete'){
                    return '<span class="badge bg-inverse-success">Complete</span>';
 
                 }
                 else if($data->status === 'inprogress'){
                    return '<span class="badge bg-warning text-dark">In Progress</span>';
                 }
                 
              //  return $data->status;
            })  ->rawColumns(['status']) ->make(true);
       
        }
             
        $travel_status = $request->status;
 
        return view('admin.travelRecords.travelRequest_status',compact('travel_status', 'date'));
 
    }
}
