<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nationalities;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Yajra\DataTables\Facades\DataTables;

class NationalityController extends Controller
{
    public function list(Request $request)
    {
        $data = Nationalities::get();

        if ($request->ajax()) {
            return DataTables::of($data)
        
            ->addColumn('name', function ($data) {
                return $data->name;
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
        return view('admin.metaData.nationality.list');
    }
    public function store(Request $request)
    {
        try {
            $validator = FacadesValidator::make($request->all(), [
                'name' => 'required|string',
            ], [
                'name.required' => 'Name is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            Nationalities::create($request->only(['name']));
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Nationality created successfully.',
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
        $nationality = Nationalities::findOrFail($id);
        return response()->json($nationality);
    }
    public function update(Request $request, $id)
    {

        try {
            $validator = FacadesValidator::make($request->all(), [
                'name' => 'required|string',
            ], [
                'name.required' => 'Name is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            $nationality = Nationalities::findOrFail($id);
    
            $nationality->update([
                'name' => $request->input('name'),
            ]);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Nationality updated successfully.',
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
            $nationality = Nationalities::findOrFail($id);
            $nationality->delete();
            return response()->json([
                'result' => 'success',
                'msg' => 'Nationality deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Failed to delete Nationality.',
            ]);
        }
    } 
}
