<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function list(Request $request)
    {
        $employeeId = $request->employee;
        $data = Attendance::with('employeeAtt')
        ->when($employeeId, function ($query) use ($employeeId) {
            return $query->where('employee', $employeeId);
        })
        ->get();


        if ($request->ajax()) {
            return DataTables::of($data)
            ->addColumn('employee', function ($data) {
                return $data->employeeAtt->name;
            })
            ->addColumn('in_time', function ($data) {
                return date("d M Y H:i", strtotime($data->in_time));
            })
            ->addColumn('out_time', function ($data) {
                if($data->out_time){
                    return date("d M Y H:i", strtotime($data->out_time));
                }
                
            })
 
            ->addColumn("action", function ($data) {
                $button = '<div style="display:flex;">
                    <a href="javascript:void(0)"
                       class="btn btn-info mr-1 btn-edit"
                       style="font-size:smaller; font-weight:bold;"
                       data-id="' . $data->id . '">Edit</a>
                       <a href="javascript:void(0)"
                       class="btn btn-primary btn-delete"
                       style="font-size:smaller; font-weight:bold;"
                       data-id="' . $data->id . '">Delete</a>
                </div>';
                return $button;
            })
                ->make(true);
        }
        $employees = User::select('id','name')->where('role_name','Employee')->get();
        return view('admin.attendance.list',['employees'=>$employees]);
    }
    public function store(Request $request)
    {
        try {
           
            $validator = Validator::make($request->all(), [
                'employee' => 'required',
                'in_time' => 'required',
            ], [
                'employee.required' => 'Employee is required.',
                'in_time.required' => 'Time-In is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }

                $data = $request->only([
                    'employee', 
                    'in_time',
                    'out_time',
                    'note',
                ]);

                Attendance::create($data);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Attendance created successfully.',
            ]);
        } catch (\Exception $e) {
            app(\App\Exceptions\Handler::class)->report($e);
    
            return response()->json([
                'result' => 'failure',
                'msg' => 'An error occurred. Please try again.',
            ]);
        }
    }
    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        return response()->json($attendance);
    }
    public function update(Request $request, $id)
    {

        try {
            $validator = Validator::make($request->all(), [
                'employee' => 'required',
                'in_time' => 'required',
            ], [
                'employee.required' => 'Employee is required.',
                'in_time.required' => 'Time-In is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            $attendance = Attendance::findOrFail($id);
            $attendance->update([
                'employee' => $request->input('employee'),
                'in_time' => $request->input('in_time'),
                'out_time' => $request->input('out_time'),
                'note' => $request->input('note'),
            ]);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Attendance updated successfully.',
            ]);
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
            $attendance = Attendance::findOrFail($id);
            $attendance->delete();
            return response()->json([
                'result' => 'success',
                'msg' => 'Attendance deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Failed to delete Attendance.',
            ]);
        }
    }





    public function index(Request $request)
    {
        $query = Attendance::with('user'); // Eager loading
 
        // Filter by employee ID (correct column name)
        if ($request->filled('employee')) {
            $query->where('employee', $request->employee);
        }
 
        // Filter by start date
        if ($request->filled('start_date')) {
            $query->whereDate('in_time', '>=', $request->start_date);
        }
 
        // Filter by end date
        if ($request->filled('end_date')) {
            $query->whereDate('in_time', '<=', $request->end_date);
        }
 
        // Filter by attendance status (if it belongs to Attendance table)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
 
        $attendances = $query->orderBy('in_time', 'desc')->get();
        $users = User::all();

        return view('attendances.index', compact('attendances', 'users'));
    }


    
 
}
