<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function list(Request $request)
    {
        $data = Category::get();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name;
                })

                ->addColumn("action", function ($data) {
                    $button = '<div style="display:flex; justify-content:center">
                    <a href="javascript:void(0)"
                       class="btn btn-info mr-1 btn-edit"
                       style="font-size:smaller; font-weight:bold;"
                       data-id="' . $data->id . '">Edit</a>
                        <a href="javascript:void(0)"
                         class="btn btn-danger btn-delete"
                         style="font-size:smaller; font-weight:bold;"
                         data-id="' . $data->id . '">Delete</a>
                              </div>';
                    return $button;
                })
                ->make(true);
        }
        return view('admin.category.list');
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

            Category::create($request->only(['name']));

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
        $skill = Category::findOrFail($id);
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

            $skill = Category::findOrFail($id);

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
            \Log::info("Attempting to delete category with ID: $id");
            $category = Category::find($id);

            if (!$category) {
                \Log::warning("Category not found: $id");
                return response()->json(['result' => 'error', 'message' => 'Category not found.']);
            }

            $category->delete();
            \Log::info("Deleted category: $id");

            return response()->json(['result' => 'success']);
        } catch (\Exception $e) {
            \Log::error("Delete exception: " . $e->getMessage());
            return response()->json([
                'result' => 'error',
                'message' => 'Exception: ' . $e->getMessage(),
            ]);
        }
    }


}
