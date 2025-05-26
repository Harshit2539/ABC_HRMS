<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class PoliciesController extends Controller
{
    public function index()
    {
        $generalPolicies = Policy::where('policy_category', 'General Policy')->where('status', 'active')->get();
        $internalPolicies = Policy::where('policy_category', 'Internal Policy')->where('status', 'active')->get();
        // dd($generalPolicies, $internalPolicies);
        return view('admin.document.policies', compact('generalPolicies', 'internalPolicies'));
    }
}
