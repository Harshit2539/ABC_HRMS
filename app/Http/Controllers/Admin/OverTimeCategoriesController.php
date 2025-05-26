<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OverTimeCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OverTimeCategoriesController extends Controller
{
    public function list(Request $request)
    {
        $data = OverTimeCategories::get();

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
        return view('admin.overtime.categories_list');
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
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
    
            OverTimeCategories::create($request->only(['name']));
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Overtime Category created successfully.',
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
        $overtime_category = OverTimeCategories::findOrFail($id);
        return response()->json($overtime_category);
    }
    public function update(Request $request, $id)
    {

        try {
            $validator = Validator::make($request->all(), [
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
    
            $overtime_category = OverTimeCategories::findOrFail($id);
    
            $overtime_category->update([
                'name' => $request->input('name'),
            ]);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Overtime Category updated successfully.',
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
            $overtime_category = OverTimeCategories::findOrFail($id);
            $overtime_category->delete();
            return response()->json([
                'result' => 'success',
                'msg' => 'Overtime Category deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Failed to delete Overtime Category.',
            ]);
        }
    } 
}
