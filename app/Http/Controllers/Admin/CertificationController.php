<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CertificationController extends Controller
{
    public function list(Request $request)
    {
        $data = Certifications::get();

        if ($request->ajax()) {
            return DataTables::of($data)
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
            })
                ->make(true);
        }
        return view('admin.qualificationSetup.certifications.list');
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ], [
                'name.required' => 'Name is required.',
                'description.required' => 'Description is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            Certifications::create($request->only(['name', 'description']));
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Certification created successfully.',
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
        $certification = Certifications::findOrFail($id);
        return response()->json($certification);
    }
    public function update(Request $request, $id)
    {

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ], [
                'name.required' => 'Name is required.',
                'description.required' => 'Description is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            $certification = Certifications::findOrFail($id);
    
            $certification->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Certification updated successfully.',
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
            $certification = Certifications::findOrFail($id);
            $certification->delete();
            return response()->json([
                'result' => 'success',
                'msg' => 'Certification deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Failed to delete Certification.',
            ]);
        }
    } 
}
