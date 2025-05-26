<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    public function list(Request $request)
    {
        $data = Countries::get();

        if ($request->ajax()) {
            return DataTables::of($data)
            ->addColumn('code', function ($data) {
                return $data->code;
            })
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
        return view('admin.metaData.countries.list');
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'code' => 'required|string|max:2',
                'name' => 'required|string',
            ], [
                'code.required' => 'Code is required.',
                'code.max' => 'The code must not exceed :max characters.',
                'name.required' => 'Name is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            Countries::create($request->only(['name', 'code']));
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Countary created successfully.',
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
        $countary = Countries::findOrFail($id);
        return response()->json($countary);
    }
    public function update(Request $request, $id)
    {

        try {
            $validator = Validator::make($request->all(), [
                'code' => 'required|string|max:2',
                'name' => 'required|string',
            ], [
                'code.required' => 'Code is required.',
                'code.max' => 'The code must not exceed :max characters.',
                'name.required' => 'Name is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            $countary = Countries::findOrFail($id);
    
            $countary->update([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
            ]);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Countary updated successfully.',
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
            $countary = Countries::findOrFail($id);
            $countary->delete();
            return response()->json([
                'result' => 'success',
                'msg' => 'Countary deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Failed to delete Countary.',
            ]);
        }
    } 
}
