<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OverTimeCategories;
use App\Models\OverTimeRequests;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OverTimeRequestsController extends Controller
{
    public function list(Request $request)
    {
        $data = OverTimeRequests::with('employee','project','category')->get();

        if ($request->ajax()) {
            return DataTables::of($data)
        
            ->addColumn('employee_id', function ($data) {
                return $data->employee->name;
            })
            ->addColumn('category_id', function ($data) {
                return $data->category->name;
            })
            ->addColumn('start_time', function ($data) {
                return date("d M Y H:i", strtotime($data->start_time));
            })
            ->addColumn('end_time', function ($data) {
                return date("d M Y H:i", strtotime($data->end_time));
            })
            ->addColumn('project_id', function ($data) {
                if($data->project->name){
                    return $data->project->name;
                }
              
            })
            ->addColumn('status', function ($data) {
                return $data->status;
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
        $projects = Projects::select('id','name')->get();
        $categories = OverTimeCategories::select('id','name')->get();
        return view('admin.overtime.requests_list',(['employees'=>$employees,'projects'=>$projects,'categories'=>$categories,]));
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'employee_id' => 'required',
                'category_id' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'status' => 'required',
            ], [
                'employee_id.required' => 'Employee is required.',
                'category_id.required' => 'Category is required.',
                'start_time.required' => 'Start Time is required.',
                'end_time.required' => 'End Time is required.',
                'status.required' => 'Status is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            OverTimeRequests::create($request->only(['employee_id','category_id','project_id','start_time','end_time','status','notes']));
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Overtime Request created successfully.',
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
        $overtime_request = OverTimeRequests::findOrFail($id);
        return response()->json($overtime_request);
    }
    public function update(Request $request, $id)
    {

        try {
            $validator = Validator::make($request->all(), [
                'employee_id' => 'required',
                'category_id' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'status' => 'required',
            ], [
                'employee_id.required' => 'Employee is required.',
                'category_id.required' => 'Category is required.',
                'start_time.required' => 'Start Time is required.',
                'end_time.required' => 'End Time is required.',
                'status.required' => 'Status is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            $overtime_request = OverTimeRequests::findOrFail($id);
    
            $overtime_request->update([
                'employee_id' => $request->input('employee_id'),
                'category_id' => $request->input('category_id'),
                'project_id' => $request->input('project_id'),
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time'),
                'status' => $request->input('status'),
                'notes' => $request->input('notes'),
            ]);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Overtime Request updated successfully.',
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
            $overtime_request = OverTimeRequests::findOrFail($id);
            $overtime_request->delete();
            return response()->json([
                'result' => 'success',
                'msg' => 'Overtime Request deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Failed to delete Overtime Request.',
            ]);
        }
    } 
}
