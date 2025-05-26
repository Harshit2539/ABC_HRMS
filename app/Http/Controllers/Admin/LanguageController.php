<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Languages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class LanguageController extends Controller
{
    public function list(Request $request)
    {
        $data = Languages::get();

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
        return view('admin.qualificationSetup.languages.list');
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
    
            Languages::create($request->only(['name', 'description']));
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Language created successfully.',
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
        $language = Languages::findOrFail($id);
        return response()->json($language);
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
    
            $language = Languages::findOrFail($id);
    
            $language->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Language updated successfully.',
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
            $language = Languages::findOrFail($id);
            $language->delete();
            return response()->json([
                'result' => 'success',
                'msg' => 'Language deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Failed to delete Language.',
            ]);
        }
    } 
}
