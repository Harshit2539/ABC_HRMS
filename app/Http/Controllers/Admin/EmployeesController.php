<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables;

class EmployeesController extends Controller
{
    public function list(Request $request){

        $data = Employee::with(['user', 'department_name'])
               ->whereHas('user', function($q){
                return $q->where('status', 'Active');
               })->where('for_country', 'ca')->orderBy('id', 'DESC')->get();
       
        if ($request->ajax()) {

            return DataTables::of($data)

            ->addColumn('olm_id', function ($data) {
                return $data->olm_id ?? "nil";
            })
            // ->addColumn('workstation_id', function ($data) {
            //     return $data->workstation_id ?? "nil";
            // })
            ->addColumn('name', function ($data) {
                if(!empty($data->first_name)){
                    return $data->first_name." ".$data->last_name;
                   }
            })
            
            ->addColumn('department', function ($data) {
                if(!empty($data->department_name->department)){
                    return $data->department_name->department;
                   }
            })
            ->addColumn('status', function ($data) {
                if (!empty($data->user->status)) {
                    if ($data->user->status === 'Active') {
                        return '<span class="badge bg-inverse-success">Active</span>';
                    } elseif ($data->user->status === 'Inactive') {
                        return '<span class="badge bg-inverse-danger">Inactive</span>';
                    }
                }
                return '<span class="badge bg-secondary">Unknown</span>'; // Fallback for unknown status
            })

 
            // ->addColumn("action", function ($data) {
            //     $button = '<div style="display:flex;">
            //         <a href="javascript:void(0)"
            //            class="btn btn-info mr-1 btn-edit"
            //            style="font-size:smaller; font-weight:bold;"
            //            data-id="' . $data->id . '">Edit</a>
            //         <a href="javascript:void(0)"
            //            class="btn btn-primary btn-delete"
            //            style="font-size:smaller; font-weight:bold;"
            //            data-id="' . $data->id . '">Delete</a>
            //     </div>';
            //     return $button;
            // })
            ->addColumn("action", function ($data) {
                $button = '<div style="display:flex;">
                    <a href="javascript:void(0)"
                       class="btn btn-danger mr-1 btn-remove"
                       style="font-size:smaller; font-weight:bold;"
                       data-id="' . $data->id . '">Remove from System</a>
                       <a href="javascript:void(0)"
                       class="btn btn-danger mr-1 btn-edit"
                        href="#" onclick="app.editAsset('.htmlspecialchars(json_encode($data)).')"><i class="fa fa-pencil"></i></a>
                    
                </div>';
                return $button;
            })
            ->rawColumns(['status', 'action']) // Render badges properly

                ->make(true);
        }
        return view('admin.employee.list');
    }

    public function inactiveUsers(Request $request){

        $data = Employee::with(['user', 'department_name'])
        ->whereHas('user', function ($query) {
            $query->where('status', 'Inactive');
        })
        ->get();
       
        if ($request->ajax()) {

            return DataTables::of($data)

            ->addColumn('olm_id', function ($data) {
                return $data->olm_id ?? "nill";
            })
            ->addColumn('registration_no', function ($data) {
                return $data->registration_no ?? "nill";
            })
            ->addColumn('name', function ($data) {
                if(!empty($data->first_name)){
                    return $data->first_name." ".$data->last_name;
                   }
            })
            
            ->addColumn('department', function ($data) {
                if(!empty($data->department_name->department)){
                    return $data->department_name->department;
                   }
            })
            ->addColumn('status', function ($data) {
                if (!empty($data->user->status)) {
                    if ($data->user->status === 'Active') {
                        return '<span class="badge bg-inverse-success">Active</span>';
                    } elseif ($data->user->status === 'Inactive') {
                        return '<span class="badge bg-inverse-danger">Inactive</span>';
                    }
                }
                return '<span class="badge bg-secondary">Unknown</span>'; // Fallback for unknown status
            })

 
            ->addColumn("action", function ($data) {
                $removeButton = '';
                
                // Add the "View" button
                $viewButton = '<a href="javascript:void(0)"
                                    class="btn btn-secondary btn-view"
                                    style="font-size:smaller; font-weight:bold;"
                                    data-id="' . $data->id . '"><i class="fa fa-eye" aria-hidden="true"></i></a>';
            
                // Combine buttons
                $button = '<div style="display:flex;">' . $removeButton . $viewButton . '</div>';
                return $button;
            })
            ->rawColumns(['status', 'action']) // Render badges properly

                ->make(true);
        }
        return view('admin.employee.inactive_employee');

    }

    public function saveExitQuestions(Request $request)
    {
        $userId = $request->user_id;
        $user = Employee::find($userId);
        $questions = $request->questions; // Array of questions
        $answers = $request->answers;    // Array of answers

        foreach ($questions as $key => $question) {
            DB::table('user_exit_qas')->insert([
                'user_id' => $userId,
                'question' => $question,
                'answer' => $answers[$key],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        DB::table('users')->where('id', $user->employee_id)->update(['status'=> 'Inactive']);
        return response()->json(['success' => 'Data saved successfully']);
    }

    public function viewExitQuestions($id)
    {
        $data = DB::table('user_exit_qas')->where('user_id', $id)->get();
        return response()->json($data);
    }



}
