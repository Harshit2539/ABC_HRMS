<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientDetails;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function  list(Request $request)
    {
        $data = Projects::with('user')->get();

        if ($request->ajax()) {
            return DataTables::of($data)
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('user', function ($data) {
                return $data->user->name;
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
        $users = User::where('role_name','Client')->get();
        $client = ClientDetails::all();
        return view('admin.project.list',['users'=>$users],['client'=>$client]);
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'status' => 'required',
                'client_id' => 'required',
            ], [
                'name.required' => 'Name is required.',
                'status.required' => 'Status is required.',
                'client_id.required' => 'Client is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            Projects::create($request->only(['name', 'details','client_id','status']));
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Project created successfully.',
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
        $project = Projects::findOrFail($id);
        return response()->json($project);
    }
    public function update(Request $request, $id)
    {

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'status' => 'required',
                'client_id' => 'required',
            ], [
                'name.required' => 'Name is required.',
                'status.required' => 'Status is required.',
                'client_id.required' => 'Client is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            $project = Projects::findOrFail($id);
    
            $project->update([
                'name' => $request->input('name'),
                'details' => $request->input('details'),
                'client_id' => $request->input('client_id'),
                'status' => $request->input('status'),
            ]);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Project updated successfully.',
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
            $project = Projects::findOrFail($id);
            $project->delete();
            return response()->json([
                'result' => 'success',
                'msg' => 'Project deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Failed to delete Project.',
            ]);
        }
    }
}
