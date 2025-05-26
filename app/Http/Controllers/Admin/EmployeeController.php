<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeProjects;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
     
  
      public function project_list(Request $request)
      {
          $data = EmployeeProjects::with('user','project')->get();
  
          if ($request->ajax()) {
              return DataTables::of($data)
            
              ->addColumn('user', function ($data) {
                  return $data->user->name;
              })
              ->addColumn('project', function ($data) {
                  return $data->project->name;
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
          $users = User::where('role_name','!=','Admin')->get();
          $projects = Projects::get();
          return view('admin.employee.project_list',['users'=>$users,'projects'=>$projects]);
      }
  
      public function store(Request $request)
      {
          try {
              $validator = Validator::make($request->all(), [
                  'emp_id' => 'required',
                  'project_id' => 'required',
                  'details' => 'required',
              ], [
                  'emp_id.required' => 'Employee is required.',
                  'project_id.required' => 'Project is required.',
                  'details.required' => 'Details is required.',
              ]);
      
              if ($validator->fails()) {
                  return response()->json([
                      'result' => 'error',
                      'msg' => $validator->errors(),
                  ]);
              }
      
              EmployeeProjects::create($request->only(['emp_id', 'details','project_id']));
      
              return response()->json([
                  'result' => 'success',
                  'msg' => 'Employee Project created successfully.',
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
          $project = EmployeeProjects::findOrFail($id);
          return response()->json($project);
      }
  
      public function update(Request $request, $id)
      {
  
          try {
              $validator = Validator::make($request->all(), [
                  'emp_id' => 'required',
                  'project_id' => 'required',
                  'details' => 'required',
              ], [
                  'emp_id.required' => 'Employee is required.',
                  'project_id.required' => 'Project is required.',
                  'details.required' => 'Details is required.',
              ]);
              if ($validator->fails()) {
                  return response()->json([
                      'result' => 'error',
                      'msg' => $validator->errors(),
                  ]);
              }
      
              $project = EmployeeProjects::findOrFail($id);
      
              $project->update([
                  'emp_id' => $request->input('emp_id'),
                  'details' => $request->input('details'),
                  'project_id' => $request->input('project_id')
              ]);
      
              return response()->json([
                  'result' => 'success',
                  'msg' => 'Employee Project updated successfully.',
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
              $project = EmployeeProjects::findOrFail($id);
              $project->delete();
              return response()->json([
                  'result' => 'success',
                  'msg' => 'Employee Project deleted successfully.',
              ]);
          } catch (\Exception $e) {
              return response()->json([
                  'result' => 'error',
                  'msg' => 'Failed to delete Employee Project.',
              ]);
          }
      }
}
