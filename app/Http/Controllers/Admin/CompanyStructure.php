<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyStructure as ModelsCompanyStructure;
use App\Models\Countries;
use App\Models\Timezone;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CompanyStructure extends Controller
{
    public function index(Request $request){

        if($request->ajax()){
            $data = ModelsCompanyStructure::with('parent_detail', 'country_detail')->orderBy('id', 'desc');
            $data = $data;
            return DataTables::of($data->get())
            
            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('address', function ($data) {
                return $data->address;
            })
            ->addColumn('type', function ($data) {
                return $data->type;
            })
            ->addColumn('country', function ($data) {
                return $data->country_detail->code;
            })
            ->addColumn('timezone', function ($data) {
                return $data->timezone;
            })
            ->addColumn('parent', function ($data) {
                return $data->parent_detail->title ?? 'null';
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
            }
            )
            
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    
        }
        $data['countries'] = Countries::all(['id', 'name']);
        $data['timezones'] = Timezone::all(['id', 'details']);
        $data['companies'] = ModelsCompanyStructure::all(['id', 'title']);
        $data['employees'] = User::where('role_name', 'Employee')->get(['id', 'name']);

        return view('admin.companyStructureSetup.companyStructure.index', $data);
    }


    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'detail' => 'required|string|max:255',
        'country_id' => 'required|exists:countries,id',
        'timezone_id' => 'required|exists:timezones,id',
    ]);

    // try {
        // Insert data into the company_structure table
        $company_structure_id = ModelsCompanyStructure::create([
            'title' => $request->name,
            'description' => $request->detail,
            'address' => $request->address,
            'type' => $request->type,
            'country' => $request->country_id,
            'timezone' => $request->timezone_id,
            'parent' => $request->parent_id,
            'created_at' => now(),
            'updated_at' => now(),

            // 'head_id' => $request->head_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Company structure added successfully.']);
    // } catch (\Exception $e) {
    //     return response()->json(['success' => false, 'message' => 'Failed to add company structure.']);
    // }
}

}
