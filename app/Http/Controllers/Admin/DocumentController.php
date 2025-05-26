<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        return view('admin.document.index');
    }

    public function policies()
    {
        
        return view('admin.document.policies'); // Ensure this Blade file exists
    }

    public function payslip()
    {
 
        return view('admin.document.payslip');
    }
}
