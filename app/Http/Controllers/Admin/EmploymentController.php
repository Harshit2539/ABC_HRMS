<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmploymentStatus;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $data = EmploymentStatus::orderBy('id', 'desc');

            // $data = $data;
            return DataTables()->of($data->get())
            
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('description', function ($data) {
                return $data->description;
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
            }
            )
            
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    
        }
        return view('admin.jobDetailSetup.EmploymentStatus.index');
    }

    public function store(Request $request){
        $request->validate([
            'employmentstatus' => 'required',
            'description' => 'required',
        ]);
        $EmploymentStatus = new EmploymentStatus();
        $EmploymentStatus->name = $request->employmentstatus;
        $EmploymentStatus->description = $request->description;
        if($EmploymentStatus->save()){
            return response()->json(['status' => true , 'message' => 'Employment Status added successfully']);
        }else{
            return response()->json(['status'=> false, 'message' => 'Something Went Wrong']);
        }
    }


    public function edit($id)
    {
        $EmploymentStatus = EmploymentStatus::findOrFail($id);
        return response()->json($EmploymentStatus);
    }

    public function update(Request $request, $id)
    {

        $EmploymentStatus = EmploymentStatus::findOrFail($id);
        $EmploymentStatus->name = $request->employmentstatus;
        $EmploymentStatus->description = $request->description;
        if($EmploymentStatus->save()){
            $EmploymentStatus->update();
            return response()->json(['status'=>true, 'message' => 'Employment Status updated successfully']);
        }else{
            return response()->json(['status'=>false, 'message' => 'Something Went Wrong']);
        }

    }

    public function destroy($id)
    {
        EmploymentStatus::destroy($id);
        return response()->json(['message' => 'Employment Status deleted successfully']);
    }
}
