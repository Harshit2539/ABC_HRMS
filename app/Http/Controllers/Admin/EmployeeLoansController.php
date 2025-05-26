<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CurrencyTypes;
use App\Models\EmployeeLoans;
use App\Models\LoanTypes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EmployeeLoansController extends Controller
{
    public function list(Request $request)
    {
        $query = EmployeeLoans::with('employee','loan','currency');
        if ($request->employee_id) {
            $query->where('employee_id', $request->employee_id);
        }
        if ($request->loan_id) {
            $query->where('loan_id', $request->loan_id);
        }
        $data = $query->get();
 
        if ($request->ajax()) {
            return DataTables::of($data)
        
            ->addColumn('employee', function ($data) {
                return $data->employee->name;
            })
            ->addColumn('loan', function ($data) {
                    return $data->loan->name;
             })
             ->addColumn('start_date', function ($data) {
                return $data->start_date;
             })
             ->addColumn('period_months', function ($data) {
                return $data->period_months;
             })
             ->addColumn('currency', function ($data) {
                return $data->currency->name;
             })
             ->addColumn('amount', function ($data) {
                return $data->amount;
             })
             ->addColumn('status', function ($data) {
                return $data->status;
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
        $employees = User::where('role_name','Employee')->get();
 
    
        if (auth()->user()->role_name == 'HR') {
            $approve1 = User::where('role_name','HR')->where('id', '!=', auth()->id())->get();
        } else {
            $approve1 = User::where('role_name','HR')->get();
        }
        if (auth()->user()->role_name == 'Direct superior') {
            $approve2 = User::where('role_name','Direct superior')->where('id', '!=', auth()->id())->get();
        } else {
            $approve2 = User::where('role_name','Direct superior')->get();
        }
        if (auth()->user()->role_name == 'DGA') {
            $approve3 = User::where('role_name','DGA')->where('id', '!=', auth()->id())->get();
        } else {
            $approve3 = User::where('role_name','DGA')->get();
        }

        $currencies = CurrencyTypes::get();
        $loans = LoanTypes::get();
        return view('admin.loans.employee_loans',([ 'approve1'=>$approve1,'approve2'=> $approve2,'approve3'=> $approve3,'employees'=>$employees,'currencies'=>$currencies,'loans'=>$loans]));
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'employee_id' => 'required',
                'currency_id' => 'required',
                'loan_id' => 'required',
                'start_date' => 'required',
                'last_installment_date' => 'required',
                'period_months' => 'required|integer',
                'amount' => 'required',
                'monthly_installment' => 'required',
                'status' => 'required',
            ], [
                'employee_id.required' => 'Employee is required.',
                'currency_id.required' => 'Currency is required.',
                'loan_id.required' => 'Loan Type is required.',
                'start_date.required' => 'Loan Start Date is required.',
                'last_installment_date.required' => 'Last Installment Date is required.',
                'period_months.required' => 'Loan Period is required.',
                'period_months.integer' => 'The period months must be an integer.',
                'amount.required' => 'Loan Amount is required.',
                'monthly_installment.required' => 'Monthly Installment is required.',
                'status.required' => 'Status is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            $employee= new EmployeeLoans();
            $employee->employee_id = $request->employee_id;
            $employee->currency_id = $request->currency_id;
            $employee->loan_id = $request->loan_id;
            $employee->start_date = $request->start_date;
            $employee->last_installment_date = $request-> last_installment_date;
            $employee->period_months = $request->period_months;
            $employee->approver1 = $request->approver1;
            $employee->approver2 = $request->approver2;
            $employee->approver3 = $request->approver3;
            $employee->amount = $request->amount;
            $employee->monthly_installment = $request->monthly_installment;
            $employee->status = $request -> status;
            $employee->details = $request->details;
            if($employee->save()){
 
                return response()->json(['status' => true , 'msg' => ' data add succrssfully']);
            }else{
                return response()->json(['status' => false , 'msg' => 'Somthings want wrong']);
            }
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
        $emp_loan = EmployeeLoans::findOrFail($id);
        return response()->json($emp_loan);
    }

    public function update(Request $request, $id)
    {
 
        try {
            $validator = Validator::make($request->all(), [
                'employee_id' => 'required',
                'currency_id' => 'required',
                'loan_id' => 'required',
                'start_date' => 'required',
                'last_installment_date' => 'required',
                'period_months' => 'required|integer',
                'amount' => 'required',
                'monthly_installment' => 'required',
                'status' => 'required',
            ], [
                'employee_id.required' => 'Employee is required.',
                'currency_id.required' => 'Currency is required.',
                'loan_id.required' => 'Loan Type is required.',
                'start_date.required' => 'Loan Start Date is required.',
                'last_installment_date.required' => 'Last Installment Date is required.',
                'period_months.required' => 'Loan Period is required.',
                'period_months.integer' => 'The period months must be an integer.',
                'amount.required' => 'Loan Amount is required.',
                'monthly_installment.required' => 'Monthly Installment is required.',
                'status.required' => 'Status is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            $emp_loan = EmployeeLoans::findOrFail($id);
    
            $emp_loan->update([
                'employee_id' => $request->input('employee_id'),
                'currency_id' => $request->input('currency_id'),
                'loan_id' => $request->input('loan_id'),
                'start_date' => $request->input('start_date'),
                'last_installment_date' => $request->input('last_installment_date'),
                'period_months' => $request->input('period_months'),
                'amount' => $request->input('amount'),
                'monthly_installment' => $request->input('monthly_installment'),
                'approver1' => $request->input('approver1'),
                'approver2' => $request->input('approver2'),
                'approver3' => $request->input('approver3'),
                'status' => $request->input('status'),
                'details' => $request->input('details'),
            ]);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Employee Loan updated successfully.',
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
            $emp_loan = EmployeeLoans::findOrFail($id);
            $emp_loan->delete();
            return response()->json([
                'result' => 'success',
                'msg' => 'Employee Loan deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Failed to delete Employee Loan.',
            ]);
        }
    } 
}
