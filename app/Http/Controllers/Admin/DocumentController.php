<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
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

        return view('admin.document.policies');
    }

    public function payslip()
    {
        $employeeId = auth()->user()->employee_id;

        $data = DB::table('employee_payslip')
            ->where('employee_id', $employeeId)
            ->get();
        return view('admin.document.payslip', compact('data'));
    }
}
