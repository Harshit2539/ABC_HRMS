<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class LoanTypesController extends Controller
{
    public function list(Request $request)
    {
        $data = LoanTypes::get();

        if ($request->ajax()) {
            return DataTables::of($data)
        
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('details', function ($data) {
                if($data->details){
                    return $data->details;
                }
               
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
        return view('admin.loans.loan_types');
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
    
            LoanTypes::create($request->only(['name','details']));
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Loan Type created successfully.',
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
        $loan_type = LoanTypes::findOrFail($id);
        return response()->json($loan_type);
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
    
            $loan_type = LoanTypes::findOrFail($id);
    
            $loan_type->update([
                'name' => $request->input('name'),
                'details' => $request->input('details'),
            ]);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Loan Type updated successfully.',
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
            $loan_type = LoanTypes::findOrFail($id);
            $loan_type->delete();
            return response()->json([
                'result' => 'success',
                'msg' => 'Loan Type deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Failed to delete Loan Type.',
            ]);
        }
    } 
}
