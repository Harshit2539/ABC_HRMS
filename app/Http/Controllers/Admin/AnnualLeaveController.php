<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnnualLeave;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AnnualLeaveController extends Controller
{
    public function annualLeaves(Request $request){


        $data = AnnualLeave::get(['id', 'year', 'annual_leave', 'work_from_home', 'sick_leave', 'restrict_leave']);


        if ($request->ajax()) {
            return DataTables::of($data)
            ->addColumn('year', function ($data) {
                return $data->year;
            })
            ->addColumn('annual_leave', function ($data) {
                return $data->annual_leave;
            })
            ->addColumn('work_from_home', function ($data) {
                return $data->work_from_home;
            })
            ->addColumn('sick_leave', function ($data) {
                return $data->sick_leave;
            })
            ->addColumn('restrict_leave', function ($data) {
                return $data->restrict_leave;
            })
            // ->addColumn("action", function ($data) {
            //     $button = '<div style="display:flex;">
            //         <a href="javascript:void(0)"
            //            class="btn btn-info mr-1 btn-edit"
            //            style="font-size:smaller; font-weight:bold;"
            //            data-id="' . $data->id . '">Edit</a>
            //            <a href="javascript:void(0)"
            //            class="btn btn-primary btn-delete"
            //            style="font-size:smaller; font-weight:bold;"
            //            data-id="' . $data->id . '">Delete</a>
            //     </div>';
            //     return $button;
            // })
                ->make(true);
        }
        return view('admin.annualLeave.leave');
    }

    public function store(Request $request)
    {

        
        $validated = $request->validate([
            'year' => 'required', // Ensure the year is unique
            'annual_leave' => 'required',
            'work_from_home' => 'required',
            'sick_leave' => 'required',
            'restrict_leave' => 'required',
            'annual_leave_available' => 'nullable',
            'work_from_home_available' => 'nullable',
            'sick_leave_available' => 'nullable',
            'restrict_leave_available' => 'nullable',

        ]
        );

        $existingRecord = AnnualLeave::where('year', $validated['year'])->first();
        if ($existingRecord) {
            return response()->json([
                'success' => false,
                'message' => 'The year already exists. Please choose a different year.'
            ], 400); // Return a 400 Bad Request error if the year is a duplicate
        }

        // Insert data into the database
        $annualLeave = new AnnualLeave();
        $annualLeave->year = $validated['year'];
        $annualLeave->annual_leave = $validated['annual_leave'];
        $annualLeave->work_from_home = $validated['work_from_home'];
        $annualLeave->sick_leave = $validated['sick_leave'];
        $annualLeave->restrict_leave = $validated['restrict_leave'];

        $annualLeave->annual_leave_available = $request->annual_leave_available ? 'active' : 'inactive';
        $annualLeave->work_from_home_available = $request->work_from_home_available ? 'active' : 'inactive';
        $annualLeave->sick_leave_available = $request->sick_leave_available ? 'active' : 'inactive';
        $annualLeave->restrict_leave_available = $request->restrict_leave_available ? 'active' : 'inactive';

        $annualLeave->is_delete = '0'; // Default value
        if($annualLeave->save()){
            $res['message'] = 'success';
        }else{
            $res['message'] = 'error';

        }
        return response( $res );
    }

   
}
