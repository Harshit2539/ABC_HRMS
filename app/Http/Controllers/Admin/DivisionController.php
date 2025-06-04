<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DivisionController extends Controller
{
    public function list(Request $request)
    {
        $data = Division::get();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name;
                })

                ->addColumn("action", function ($data) {
                    $button = '<div style="display:flex; justify-content:center; gap:5px">
                    <a href="javascript:void(0)"
                    class="btn btn-info btn-sm btn-edit"
                    style="font-size:smaller; font-weight:bold;"
                    data-id="' . $data->id . '">Edit</a>
        
                    <a href="javascript:void(0)"
                    class="btn btn-danger btn-sm btn-delete"
                    style="font-size:smaller; font-weight:bold;"
                    data-id="' . $data->id . '">Delete</a>
                    </div>';

                    return $button;
                })
                ->make(true);
        }
        return view('admin.divisions.list');
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
            ], [
                'name.required' => 'Name is required.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }

            Division::create($request->only(['name']));

            return response()->json([
                'result' => 'success',
                'msg' => 'Skill created successfully.',
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
        $skill = Division::findOrFail($id);
        return response()->json($skill);
    }
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
            ], [
                'name.required' => 'Name is required.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }

            $skill = Division::findOrFail($id);

            $skill->update([
                'name' => $request->input('name'),
            ]);

            return response()->json([
                'result' => 'success',
                'msg' => 'Skill updated successfully.',
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
            $skill = Division::findOrFail($id);
            $skill->delete();
            return response()->json([
                'result' => 'success',
                'msg' => 'Skill deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Failed to delete Skill.',
            ]);
        }
    }
}
