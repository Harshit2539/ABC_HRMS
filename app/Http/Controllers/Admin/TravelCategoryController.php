<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Division;
use App\Models\TravelAllowance;
use App\Models\TravelCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class TravelCategoryController extends Controller
{
    public function list(Request $request)
    {
        $data['divisions'] = Division::get();
        return view('admin.travelcategory.list', $data);
    }

    public function create(){
        $data['divisions'] = Division::get();
        $data['categories'] = Category::get();
        $data['allowances'] = TravelAllowance::get();
        
        return view('admin.travelcategory.create', $data);
    }
}
