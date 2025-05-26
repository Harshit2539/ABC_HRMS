<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Reimbursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReimbursementController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
 
        return view('admin.reimburs.index', compact('employees'));
    }
 
 
public function create()
{
    $employees = Employee::all();
    return view('admin.reimburs.create', compact('employees'));
}
 
public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'from_location' => 'required|string|max:255',
        'to_location' => 'required|string|max:255',
        'date_of_visit' => 'required|date',
        'amount' => 'required|numeric',
        'description' => 'nullable|string',
    ]);
 
    Reimbursement::create($request->all());
 
    return redirect()->route('reimburs.index')->with('success', 'Reimbursement request submitted successfully.');
}

public function details(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->role_name === 'Admin';
        $reimburs = Reimbursement::with('employee');
        if (!$isAdmin) {
            $employee = Employee::where('employee_id', $user->id)->first();
            if ($employee) {
                $reimburs->where('employee_id', $employee->id);
            } else {
                $reimburs->whereNull('employee_id');
            }
        }
        $reimburs = $reimburs->get();
        if ($request->ajax()) {
            return DataTables::of($reimburs)
                ->addColumn('employee_id', function ($reimburs) {
                    return optional($reimburs->employee)->olm_id ?? '-';
                })
                ->addColumn('from_location', function ($reimburs) {
                    return e($reimburs->from_location);
                })
                ->addColumn('to_location', function ($reimburs) {
                    return e($reimburs->to_location);
                })
                ->addColumn('date_of_visit', function ($reimburs) {
                    return e(\Carbon\Carbon::parse($reimburs->date_of_visit)->format('d M, Y'));
                })
                ->addColumn('amount', function ($reimburs) {
                    return 'Rs ' . $reimburs->amount;
                })
                ->addColumn('description', function ($reimburs) {
                    return e($reimburs->description);
                })
                ->addColumn('apply', function ($reimburs) {
                    return e(\Carbon\Carbon::parse($reimburs->created_at)->format('d M, Y'));
                })
                ->addColumn("action", function ($data) {
                    $editUrl = route('reimburs.edit', $data->id);
                    $button = '
                        <a href="' . $editUrl . '"
                           class="btn btn-info mr-1"
                           style="font-size:smaller; font-weight:bold; text-align:center;">
                         <i class="fa fa-edit"></i>
 
                        </a>
                    ';
                    return $button;
                })  
                ->rawColumns(['action', 'employee_id'])
                ->make(true);
        }
        return view('admin.reimburs.details', compact('reimburs'));
    }
    public function edit($id)
    {
        $reimburs = Reimbursement::findOrFail($id);
        $employees = Employee::all();
        return view('admin.reimburs.edit', compact('reimburs', 'employees'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'date_of_visit' => 'required|date',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
 
        $reimburs = Reimbursement::findOrFail($id);
        $reimburs->update($request->all());
 
        return redirect()->route('reimburs.details')->with('success', 'Reimbursement updated successfully.');
    }
} 
