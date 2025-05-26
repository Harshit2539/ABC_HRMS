<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\Provinces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProvinceController extends Controller
{
    public function list(Request $request)
    {
        $data = Provinces::with('countary')->get();

        if ($request->ajax()) {
            return DataTables::of($data)
            ->addColumn('code', function ($data) {
                return $data->code;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('countary', function ($data) {
                return $data->countary->name;
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
        $countries = Countries::select('id','name')->get();
        return view('admin.metaData.provinces.list',['countries'=>$countries]);
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'code' => 'required|string|max:2',
                'name' => 'required|string',
                'countary_id' => 'required',
            ], [
                'code.required' => 'Code is required.',
                'code.max' => 'The code must not exceed :max characters.',
                'name.required' => 'Name is required.',
                'countary_id.required' => 'Countary is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            Provinces::create($request->only(['name', 'code','countary_id']));
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Province created successfully.',
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
        $province = Provinces::findOrFail($id);
        return response()->json($province);
    }
    public function update(Request $request, $id)
    {

        try {
            $validator = Validator::make($request->all(), [
                'code' => 'required|string|max:2',
                'name' => 'required|string',
                'countary_id' => 'required',
            ], [
                'code.required' => 'Code is required.',
                'code.max' => 'The code must not exceed :max characters.',
                'name.required' => 'Name is required.',
                'countary_id.required' => 'Countary is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            $province = Provinces::findOrFail($id);
    
            $province->update([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'countary_id' => $request->input('countary_id')
            ]);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Province updated successfully.',
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
            $province = Provinces::findOrFail($id);
            $province->delete();
            return response()->json([
                'result' => 'success',
                'msg' => 'Province deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Failed to delete Province.',
            ]);
        }
    }
}
