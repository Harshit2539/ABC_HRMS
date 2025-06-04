<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobTitles;
use App\Models\department;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobDetailsSetupController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JobTitles::orderBy('id', 'desc')->get();

            // $data = $data;
            return DataTables::of($data)

                ->addColumn('code', function ($data) {
                    return $data->code;
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn(
                    "action",
                    function ($data) {
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
                    }
                )

                ->addIndexColumn()
                ->rawColumns(['action'])
                ->toJson();

        }


        $departments = Department::select('id', 'department')->get();


        return view('admin.jobDetailSetup.jobTitles.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required',
            'code' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'specification' => 'nullable',
        ]);

       
        if (JobTitles::where('code', $request->code)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Duplicate entry: The job code already exists.'
            ], 409); 
        }

        $jobTitle = new JobTitles();
        $jobTitle->code = $request->code;
        $jobTitle->name = $request->name;
        $jobTitle->description = $request->description;
        $jobTitle->specification = $request->specification;
        $jobTitle->department_id = $request->department;

        if ($jobTitle->save()) {
            return response()->json(['status' => true, 'message' => 'Job title added successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed to add job title']);
        }
    }


    // public function store(Request $request){


    //     $request->validate([
    //         'department'=>'required', 
    //         'code' => 'required|unique:job_titles,code',
    //         'name' => 'required',
    //         'description' => 'nullable',
    //         'specification' => 'nullable',
    //     ]);
    //     $jobTitle = new JobTitles();
    //     $jobTitle->code = $request->code;
    //     $jobTitle->name = $request->name;
    //     $jobTitle->description = $request->description;
    //     $jobTitle->specification = $request->specification;
    //     $jobTitle->department_id= $request->department;
    //     if($jobTitle->save()){
    //         return response()->json(['status' => true , 'message' => 'Job title added successfully']);
    //     }else{
    //         return response()->json(['status'=> false, 'message' => 'Job title added successfully']);
    //     }
    // }

    public function edit($id)
    {

        $departments = Department::select('id', 'department')->get();
        $jobTitle = JobTitles::findOrFail($id);
        return response()->json(['jobTitle' => $jobTitle, 'departments' => $departments]);


    }

    public function update(Request $request, $id)
    {

        $jobTitle = JobTitles::findOrFail($id);
        $jobTitle->code = $request->code;
        $jobTitle->name = $request->name;
        $jobTitle->description = $request->description;
        $jobTitle->specification = $request->specification;
        $jobTitle->department_id = $request->department;
        if ($jobTitle->save()) {
            $jobTitle->update();
            return response()->json(['status' => true, 'message' => 'Job Title updated successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something Went Wrong']);
        }

    }

    public function destroy($id)
    {
        JobTitles::destroy($id);
        return response()->json(['message' => 'Job Title deleted successfully']);
    }
}

