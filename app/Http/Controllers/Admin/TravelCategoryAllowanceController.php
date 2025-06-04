<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelCategoryAllowance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TravelCategoryAllowanceController extends Controller
{
    public function store(Request $request)
    {
        $data = json_decode($request->data, true);

        foreach ($data['child'] as $child) {
            $issueDetail = new TravelCategoryAllowance();
            $issueDetail->division_id = $child['division_id'];
            $issueDetail->category_id = $child['category_id'];
            $issueDetail->travel_allowance_id = $child['allowance_id'];
            $issueDetail->amount = $child['amount'];
            $issueDetail->save();
        }
        session()->flash('messages', 'Issued asset Successfully!');
        return redirect()->route('travelcategories.list');
    }


    public function checkCombination(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'division_id' => 'required|integer',
            'category_id' => 'required|integer',
            'allowance_id' => 'required|integer',
        ]);



        // Check if the combination exists in the travel_category_allowance table
        $exists = DB::table('travel_category_allowances')
            ->where('division_id', $request->division_id)
            ->where('category_id', $request->category_id)
            ->where('travel_allowance_id', $request->allowance_id)
            ->exists();

        return response()->json(['exists' => $exists]);
    }


    public function travelCategoryData(Request $request, $id)
    {
        $data = TravelCategoryAllowance::with(['travel_division', 'travel_category', 'travel_allowance'])->where('division_id', $id)->get();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('division_name', function ($data) {
                    return $data->travel_division->name;
                })
                ->addColumn('category_name', function ($data) {
                    return $data->travel_category->name;
                })
                ->addColumn('travel_allowance_category', function ($data) {
                    return $data->travel_allowance->name;
                })
                ->addColumn('amount', function ($data) {
                    return $data->amount;
                })
                ->addColumn("action", function ($data) {
                    $button = '<div style="display:flex; justify-content:center">
                     <a href="javascript:void(0)"
                       class="btn btn-info mr-1 btn-edit"
                       style="font-size:smaller; font-weight:bold;"
                       data-id="' . $data->id . '">Edit</a>
                </div>';
                    return $button;
                })
                ->make(true);
        }
        return view('admin.travelcategory.divisionwisecategory', compact('id'));
    }

    public function edit($id)
    {
        $amount = TravelCategoryAllowance::findOrFail($id);
        return response()->json($amount);
    }

    public function update(Request $request, $id)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'amount' => 'required|numeric|min:0',
            // ], [
            //     'amount.required' => 'Amount is required.',
            //     'amount.numeric' => 'Amount must be a number.',
            // ]);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'result' => 'error',
            //         'msg' => $validator->errors(),
            //     ]);
            // }


            $skill = TravelCategoryAllowance::findOrFail($id);

            $skill->update([
                'amount' => $request->input('amount'),
            ]);


            return response()->json([
                'result' => 'success',
                'msg' => 'Date updated successfully.',
            ]);
        } catch (\Exception $e) {
            app(\App\Exceptions\Handler::class)->report($e);

            return response()->json([
                'result' => 'failure',
                'msg' => 'An error occurred. Please try again.',
            ]);
        }
    }
}
