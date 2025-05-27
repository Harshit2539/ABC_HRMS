<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class DepartmentsController extends Controller
{
    public function index(Request $request)
    {
     $data = Department::where('deleted_at', 0)->orderBy('id', 'desc')->get();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('department', function ($data) {
                    return $data->department;
                })
                ->addColumn('action', function ($data) {
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
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.jobDetailSetup.Departments.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'departmentstatus' => 'required|unique:departments,department',
        ]);

        $department = new Department();
        $department->department = $request->departmentstatus;

        if ($department->save()) {
            return response()->json(['status' => true, 'message' => 'Department added successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return response()->json($department);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'departmentstatus' => 'required|unique:departments,department,' . $id,
        ]);

        $department = Department::findOrFail($id);
        $department->department = $request->departmentstatus;

        if ($department->save()) {
            return response()->json(['status' => true, 'message' => 'Department updated successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }

    public function destroy($id)
    {
        $department = Department::find($id)->update(['deleted_at' => 1]);
        return response()->json(['status' => true, 'message' => 'Department deleted successfully']);
    }
}

