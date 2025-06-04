<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmployeePayslipExcel;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeePayslip;
use App\Models\EmployeePayslipComponents;
use App\Models\SalaryGroupComponents;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PayrollManagementController extends Controller
{
    public function index(Request $request)
    {


        $data = Employee::with(['user' => function ($query) {
            return $query->select('id', 'name');
        }, 'department_name' => function ($quer) {
            return $quer->select('id', 'department');
        }])->select('id', 'employee_id', 'department', 'olm_id')->get();


        if ($request->ajax()) {

            return DataTables::of($data)

                ->addColumn('employee_name', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('employee_id', function ($data) {
                    if (!empty($data->olm_id)) {
                        return $data->olm_id;
                    }
                })

                ->addColumn('department', function ($data) {
                    if (!empty($data->department_name->department)) {
                        return $data->department_name->department;
                    }
                })
                ->addColumn('supervisor', function ($data) {
                    if (!empty($data->user->username)) {
                        return $data->user->name;
                    }
                })
                ->addColumn("action", function ($data) {
                    $button = '<div style="display:flex; justify-content:center">
                    <a href="' . route('employee.manage_payroll', $data->id) . '"
                       class="btn btn-info mr-1 btn-edit create-payroll"
                       style="font-size:smaller; font-weight:bold;"
                       title="View Payslip"
                       data-id="' . $data->id . '">
                       <i class="fa fa-money money-icon" aria-hidden="true"></i>
                    </a>
                     
                    <span class="create-payroll-message" style="display: none; position: absolute; top: 100%; left: 10px; color: green; font-weight: bold;">Create Payroll</span>
                </div>';
                    return $button;
                })
                ->make(true);
        }

        return view('admin.payroll.list');
    }


    public function managePayroll(Request $request)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $current_date = now();

        $employee_id = $request->id;
        $exist = EmployeePayslip::where('employee_id', $employee_id)->where('year', $year)->where('current_month', $month)->latest('id')->first();
        $salary_group = Employee::find($employee_id, ['salary_group_id']) ?? 0;

       

        $basic = 0;
        $hra =  0;
        $convience = 0;
        $bonus = 0;
        $fixed_allowance = 0;
        $medical_allowance = 0;
        $pf_employee = 0;
        $pf_employer = 0;
        $is_available = 0;

        $employee_detail = Employee::select('id', 'first_name', 'last_name', 'birthday', 'joined_date')->where('id', $employee_id)->first();
        
        
        if ($exist) {
            $is_available = 1;
            $data = EmployeePayslip::with(['employee_payslip_component'=>function($query){
                return $query->with(['component_detail']);
            }])->where('employee_id', $employee_id)->where('year', $year)->where('current_month', $month)->latest('id')->first();


            // 'employee'=> function($quer){
            //         return $quer->select();
            // }
      
            $total_deduction = $data->total_deduction;
            $gross_salary = $data->gross_salary;
            $in_hand_salary = $gross_salary - $total_deduction;
    
            
          
            foreach ($data->employee_payslip_component as $detail) {

                switch (strtolower($detail->component_detail->component_name)) {

                    case 'basic':

                        $basic = $detail->amount;

                        break;
                    case 'hra':

                        $hra = $detail->amount;

                        break;
                    case 'convience allowance':

                        $convience = $detail->amount;

                        break;
                    case 'bonus':

                        $bonus = $detail->amount;
                       

                        break;

                    case 'fixed allowance':

                        $fixed_allowance = $detail->amount;


                        break;

                    case 'medical insurance':

                        $medical_allowance = $detail->amount;

                        break;
                    case 'pf employee':

                        $pf_employee = $detail->amount;
                       

                        break;

                    case 'pf employer':

                        $pf_employer = $detail->amount;

                        break;
                }
            }
            $released_date = $data->released_date;

            return view('admin.payroll.manage_payroll', compact('data', 'employee_id', 'salary_group', 'is_available', 'basic', 'hra', 'convience', 'bonus', 'fixed_allowance', 'medical_allowance'
                                                               ,'pf_employee', 'pf_employer','total_deduction', 'gross_salary','in_hand_salary', 'employee_detail','released_date' ));
        } else {
            $released_date = "";
            $data = "";
            $total_deduction = 0;
            $gross_salary = 0;
            $in_hand_salary = 0;
            return view('admin.payroll.manage_payroll', compact('data', 'employee_id', 'salary_group', 'is_available', 'basic', 'hra', 'convience', 'bonus', 'fixed_allowance', 'medical_allowance'
            ,'pf_employee', 'pf_employer','total_deduction', 'gross_salary', 'in_hand_salary', 'employee_detail',  'released_date' ));
        }
    }

    // public function monthlyPayslipSubmit(Request $request)
    // {

    //     $res = [];

    //     $year = Carbon::now()->year;
    //     $month = Carbon::now()->month;
    //     $current_date = now();

    //     // Check if an entry already exists
    //     $existingPayslip = EmployeePayslip::where('employee_id', $request->employee_id)
    //         ->where('current_month', $month)
    //         ->where('year', $year)
    //         ->first();

    //     if ($existingPayslip) {
    //         $res['message'] = 'exists';
    //     } else {

    //         $employee_payroll = new EmployeePayslip();
    //         $employee_payroll->employee_id = $request->employee_id;
    //         $employee_payroll->year = $year;
    //         $employee_payroll->current_month = $month;
    //         $employee_payroll->released_date = $current_date;
    //         $employee_payroll->basic_salary = $request->basic_salary;
    //         $employee_payroll->overpayment = $request->overpayment;
    //         $employee_payroll->good_seperation_bonus = $request->good_seperation_bonus;
    //         $employee_payroll->absence = $request->absence;
    //         $employee_payroll->pes_seperation_allowance     = $request->pes_separation_allowance;
    //         $employee_payroll->responsibility_bonus     = $request->responsibility_bonus;
    //         $employee_payroll->seniority_bonus     = $request->seniority_bonus;
    //         $employee_payroll->attendance_bonus     = $request->attendance_bonus;
    //         $employee_payroll->performance_bonus     = $request->performance_bonus;
    //         $employee_payroll->cash_bonus     = $request->cash_bonus;
    //         $employee_payroll->housing_allowance     = $request->housing_allowance;
    //         $employee_payroll->transport_allowance     = $request->transport_allowance;
    //         $employee_payroll->electricity = $request->electricity;
    //         $employee_payroll->water = $request->water;
    //         $employee_payroll->cost_of_representation = $request->cost_of_representation;
    //         $employee_payroll->milk_bonus = $request->milk_bonus;
    //         $employee_payroll->dirt_premium = $request->dirt_premium;
    //         $employee_payroll->domestic = $request->domestic;
    //         $employee_payroll->benefit_water = $request->benefit_water;
    //         $employee_payroll->food = $request->food;
    //         $employee_payroll->month = $request->month;
    //         $employee_payroll->hrms_leave = $request->leave;
    //         $employee_payroll->mutual = $request->mutual;
    //         $employee_payroll->salary_advance = $request->salary_advance;
    //         $employee_payroll->school_credit = $request->school_credit;
    //         $employee_payroll->emergency_loan = $request->emergency_loan;
    //         $employee_payroll->ordinary_p_loan = $request->ordinary_p_loan;
    //         $employee_payroll->car_loan     = $request->car_loan;
    //         $employee_payroll->ascoma = $request->ascoma;
    //         $employee_payroll->rolling_equipment_credit = $request->rolling_equipment_credit;
    //         $employee_payroll->salary_deduction = $request->salary_deduction;
    //         $employee_payroll->notice_due_by_the_employee = $request->notice_due_by_the_employee;
    //         $employee_payroll->regul_irpp_2017 = $request->regul_irpp_2017;
    //         $employee_payroll->regul_cac_2017 = $request->regul_cac_2017;
    //         $employee_payroll->gross_salary = $request->gross_salary;
    //         $employee_payroll->contributable_salary_np     = $request->contributable_salary_np;
    //         $employee_payroll->extra1 = $request->extra1;
    //         $employee_payroll->cac_calculated = $request->cacCalculated;
    //         $employee_payroll->cfc_calculated     = $request->cfcCalculated;
    //         $employee_payroll->social = $request->social;
    //         $employee_payroll->fne = $request->FNE;
    //         $employee_payroll->alloc = $request->ALLOC;
    //         $employee_payroll->extra2 = $request->Extra2;
    //         $employee_payroll->taxable_salary = $request->taxableSalary;
    //         $employee_payroll->capped_contributory_salary = $request->cappedContributorySalary;
    //         $employee_payroll->irpp_calculated = $request->irppCalculated;
    //         $employee_payroll->tdl_calculated     = $request->tdlCalculated;
    //         $employee_payroll->rav_calculated = $request->ravCalculated;
    //         $employee_payroll->cfc = $request->CFC;
    //         $employee_payroll->pvi = $request->PVI;
    //         $employee_payroll->at = $request->AT;
    //         $employee_payroll->net_to_pay = $request->netToPay;
    //         if ($employee_payroll->save()) {
    //             $res['message'] = 'success';
    //         } else {
    //             $res['message'] = 'failed';
    //         }
    //     }


    //     return response($res);
    // }

    // public function monthlyPayslipUpdate(Request $request, $payslip_id)
    // {

    //     $res = [];
    //     $employee_payroll = EmployeePayslip::find($payslip_id);
    //     $employee_payroll->basic_salary = $request->basic_salary;
    //     $employee_payroll->overpayment = $request->overpayment;
    //     $employee_payroll->good_seperation_bonus = $request->good_seperation_bonus;
    //     $employee_payroll->absence = $request->absence;
    //     $employee_payroll->pes_seperation_allowance     = $request->pes_separation_allowance;
    //     $employee_payroll->responsibility_bonus     = $request->responsibility_bonus;
    //     $employee_payroll->seniority_bonus     = $request->seniority_bonus;
    //     $employee_payroll->attendance_bonus     = $request->attendance_bonus;
    //     $employee_payroll->performance_bonus     = $request->performance_bonus;
    //     $employee_payroll->cash_bonus     = $request->cash_bonus;
    //     $employee_payroll->housing_allowance     = $request->housing_allowance;
    //     $employee_payroll->transport_allowance     = $request->transport_allowance;
    //     $employee_payroll->electricity = $request->electricity;
    //     $employee_payroll->water = $request->water;
    //     $employee_payroll->cost_of_representation = $request->cost_of_representation;
    //     $employee_payroll->milk_bonus = $request->milk_bonus;
    //     $employee_payroll->dirt_premium = $request->dirt_premium;
    //     $employee_payroll->domestic = $request->domestic;
    //     $employee_payroll->benefit_water = $request->benefit_water;
    //     $employee_payroll->food = $request->food;
    //     $employee_payroll->month = $request->month;
    //     $employee_payroll->hrms_leave = $request->leave;
    //     $employee_payroll->mutual = $request->mutual;
    //     $employee_payroll->salary_advance = $request->salary_advance;
    //     $employee_payroll->school_credit = $request->school_credit;
    //     $employee_payroll->emergency_loan = $request->emergency_loan;
    //     $employee_payroll->ordinary_p_loan = $request->ordinary_p_loan;
    //     $employee_payroll->car_loan     = $request->car_loan;
    //     $employee_payroll->ascoma = $request->ascoma;
    //     $employee_payroll->rolling_equipment_credit = $request->rolling_equipment_credit;
    //     $employee_payroll->salary_deduction = $request->salary_deduction;
    //     $employee_payroll->notice_due_by_the_employee = $request->notice_due_by_the_employee;
    //     $employee_payroll->regul_irpp_2017 = $request->regul_irpp_2017;
    //     $employee_payroll->regul_cac_2017 = $request->regul_cac_2017;
    //     $employee_payroll->gross_salary = $request->gross_salary;
    //     $employee_payroll->contributable_salary_np     = $request->contributable_salary_np;
    //     $employee_payroll->extra1 = $request->extra1;
    //     $employee_payroll->cac_calculated = $request->cacCalculated;
    //     $employee_payroll->cfc_calculated     = $request->cfcCalculated;
    //     $employee_payroll->social = $request->social;
    //     $employee_payroll->fne = $request->FNE;
    //     $employee_payroll->alloc = $request->ALLOC;
    //     $employee_payroll->extra2 = $request->Extra2;
    //     $employee_payroll->taxable_salary = $request->taxableSalary;
    //     $employee_payroll->capped_contributory_salary = $request->cappedContributorySalary;
    //     $employee_payroll->irpp_calculated = $request->irppCalculated;
    //     $employee_payroll->tdl_calculated     = $request->tdlCalculated;
    //     $employee_payroll->rav_calculated = $request->ravCalculated;
    //     $employee_payroll->cfc = $request->CFC;
    //     $employee_payroll->pvi = $request->PVI;
    //     $employee_payroll->at = $request->AT;
    //     $employee_payroll->net_to_pay = $request->netToPay;
    //     if ($employee_payroll->update()) {
    //         $res['message'] = 'success';
    //     } else {
    //         $res['message'] = 'failed';
    //     }

    //     return response($res);
    // }

    // public function payslipDetail(Request $request, $employee_id)
    // {

    //     $data = EmployeePayslip::where('employee_id', $employee_id)->latest('id')->first();
    //     return view('admin.payroll.view_payslip', compact('data'));
    // }

    // public function filterPayslip(Request $request)
    // {

    //     $year_and_month = explode("-", $request->filterData);
    //     $year = (int)$year_and_month[0];
    //     $month = (int)$year_and_month[1];
    //     $employee = Employee::where('employee_id', $request->user_id)->first('id');

    //     if (isset($request->user_id)) {
    //         $data = EmployeePayslip::where('employee_id', $employee->id)->where('year', $year)->where('current_month', $month)->first();
    //     } else {
    //         $data = EmployeePayslip::where('employee_id', 13)->where('year', $year)->where('current_month', $month)->first();
    //     }

    //     return response()->json($data);
    // }



    // public function generatePDF(Request $request)
    // {

    //     $request->validate([
    //         'user_id' => 'required|integer',
    //         'filterData' => 'required|date',
    //     ]);

    //     // dd($request->all());

    //     $employee = Employee::where('employee_id', $request->user_id)->first();

    //     if (!$employee) {
    //         return response()->json(['error' => 'Employee not found'], 404);
    //     }
    //     $date_month = explode('-', $request->filterData);



    //     $data = EmployeePayslip::where('employee_id', $employee->id)
    //         ->where('year', (int)$date_month[0])
    //         ->where('current_month', (int)$date_month[1])
    //         ->latest('id')
    //         ->first();


    //     if (!$data) {
    //         return response()->json(['error' => 'Payslip not found for the selected date'], 404);
    //     }

    //     $pdf = PDF::loadView('payslip_pdf', compact('data', 'employee'));

    //     $pdfOutput = $pdf->output();

    //     return response()->json([
    //         'pdf_url' => 'data:application/pdf;base64,' . base64_encode($pdfOutput)
    //     ]);
    // }

    public function calculateComponents(Request $request)
    {
        $groupId = $request->input('group_id'); // or $request->group_id
        $grossSalary = $request->input('gross_salary');

        $components = SalaryGroupComponents::with(['salary_component_detail'])->where('salary_group_id', $groupId)->select('id', 'salary_component_id', 'salary_group_id')->get();

        $basic = $hra = $convience = $bonus = $fixed_allowance = $totalDeductions = 0;

        foreach ($components as $component) {
            $detail = $component->salary_component_detail;

            if ($detail->component_type === 'earning' && $detail->component_value_type == 4) {
                $value = ($grossSalary * $detail->monthly_percentage) / 100;

                switch (strtolower($detail->component_name)) {
                    case 'basic':
                        $basic = $value;
                        break;
                    case 'hra':
                        $hra = $value;
                        break;
                    case 'convience allowance':
                        $convience = $value;
                        break;
                    case 'bonus':
                        $bonus = $value;
                        break;
                    case 'fixed allowance':
                        $fixed_allowance = $value;
                        break;
                }
            } elseif ($detail->component_type === 'deduction' && $detail->component_value_type == 1) {
                switch (strtolower($detail->component_name)) {
                    case 'medical insurance':
                        $mediacl_allowance = $detail->monthly_amount;
                        break;
                    case 'pf employee':
                        $pf_employee = $detail->monthly_amount;
                        break;
                    case 'pf employer':
                        $pf_employer = $detail->monthly_amount;
                        break;
                }
                $totalDeductions += $detail->monthly_amount;
            }
        }

        $totalEarnings = $basic + $hra + $convience + $bonus + $fixed_allowance;
        $netPay = $totalEarnings - $totalDeductions;

        return response()->json([
            'basic' => round($basic, 2),
            'hra' => round($hra, 2),
            'convience' => round($convience, 2),
            'bonus' => round($bonus, 2),
            'fixed_allowance' => round($fixed_allowance, 2),
            'mediacl_allowance' => $mediacl_allowance,
            'pf_employee' => $pf_employee,
            'pf_employer' => $pf_employer,
            'total_deduction' => $totalDeductions,
            'in_hand_salary' => round($netPay, 2),
        ]);
    }


    public function saveSalary(Request $request)
    {
        try {

            $year = Carbon::now()->year;
            $month = Carbon::now()->month;
            $current_date = now();
            $group_id = $request->group_id;


            $salary_components = SalaryGroupComponents::with(['salary_component_detail' => function ($query) {
                return $query->select('id', 'component_name', 'component_type');
            }])->where('salary_group_id', $group_id)->get();

            $employee_payslip = EmployeePayslip::where('employee_id', $request->employee_id)
            ->where('year', $year)
            ->where('current_month', $month)
            ->first();

            if (!$employee_payslip) {
                $employee_payslip = new EmployeePayslip();
                $employee_payslip->employee_id = $request->employee_id;
                $employee_payslip->year = $year;
                $employee_payslip->current_month = $month;
            }

            $employee_payslip->released_date = $current_date;
            $employee_payslip->total_deduction = $request->total_deduction;
            $employee_payslip->gross_salary = $request->gross_salary;
            if ($employee_payslip->save()) {

                EmployeePayslipComponents::where('employee_payslip_id', $employee_payslip->id)->delete();


                foreach ($salary_components as $detail) {
                    $employee_payslip_component = new EmployeePayslipComponents();

                    switch (strtolower($detail->salary_component_detail->component_name)) {

                        case 'basic':

                            $employee_payslip_component->employee_payslip_id = $employee_payslip->id;
                            $employee_payslip_component->component_id = $detail->salary_component_detail->id;
                            $employee_payslip_component->amount = $request->basic;
                            $employee_payslip_component->type = $detail->salary_component_detail->component_type;

                            break;
                        case 'hra':

                            $employee_payslip_component->employee_payslip_id = $employee_payslip->id;
                            $employee_payslip_component->component_id = $detail->salary_component_detail->id;
                            $employee_payslip_component->amount = $request->hra;
                            $employee_payslip_component->type = $detail->salary_component_detail->component_type;

                            break;
                        case 'convience allowance':

                            $employee_payslip_component->employee_payslip_id = $employee_payslip->id;
                            $employee_payslip_component->component_id = $detail->salary_component_detail->id;
                            $employee_payslip_component->amount = $request->convience_allowance;
                            $employee_payslip_component->type = $detail->salary_component_detail->component_type;

                            break;
                        case 'bonus':

                            $employee_payslip_component->employee_payslip_id = $employee_payslip->id;
                            $employee_payslip_component->component_id = $detail->salary_component_detail->id;
                            $employee_payslip_component->amount = $request->bonus;
                            $employee_payslip_component->type = $detail->salary_component_detail->component_type;

                            break;
                        case 'fixed allowance':

                            $employee_payslip_component->employee_payslip_id = $employee_payslip->id;
                            $employee_payslip_component->component_id = $detail->salary_component_detail->id;
                            $employee_payslip_component->amount = $request->fixed_allowance;
                            $employee_payslip_component->type = $detail->salary_component_detail->component_type;

                            break;

                        case 'medical insurance':

                            $employee_payslip_component->employee_payslip_id = $employee_payslip->id;
                            $employee_payslip_component->component_id = $detail->salary_component_detail->id;
                            $employee_payslip_component->amount = $request->medical_insurance;
                            $employee_payslip_component->type = $detail->salary_component_detail->component_type;

                            break;
                        case 'pf employee':

                            $employee_payslip_component->employee_payslip_id = $employee_payslip->id;
                            $employee_payslip_component->component_id = $detail->salary_component_detail->id;
                            $employee_payslip_component->amount = $request->pf_employee;
                            $employee_payslip_component->type = $detail->salary_component_detail->component_type;

                            break;

                        case 'pf employer':

                            $employee_payslip_component->employee_payslip_id = $employee_payslip->id;
                            $employee_payslip_component->component_id = $detail->salary_component_detail->id;
                            $employee_payslip_component->amount = $request->pf_employer;
                            $employee_payslip_component->type = $detail->salary_component_detail->component_type;

                            break;
                    }
                    $employee_payslip_component->save();
                }
            }
            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Salary saved successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function individualPayrollInformation(Request $request)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $current_date = now();

        $employee_id = Auth::id();
            
        $salary_group = Employee::where('employee_id', Auth::id())->first();

        $exist = EmployeePayslip::where('employee_id', $salary_group->id)->where('year', $year)->where('current_month', $month)->latest('id')->first();
    
        $basic = 0;
        $hra =  0;
        $convience = 0;
        $bonus = 0;
        $fixed_allowance = 0;
        $medical_allowance = 0;
        $pf_employee = 0;
        $pf_employer = 0;
        $is_available = 0;
        $in_hand_salary = 0;
        $gross_salary = 0;
        $total_deduction = 0;
        $data =  [];
        if ($exist) {
            $is_available = 1;
            $data = EmployeePayslip::with(['employee_payslip_component'=>function($query){
                return $query->with(['component_detail']);
            }])->where('employee_id', $salary_group->id)->where('year', $year)->where('current_month', $month)->latest('id')->first();

    
            $total_deduction = $data->total_deduction;
            $gross_salary = $data->gross_salary;
            $in_hand_salary = $gross_salary - $total_deduction;
    
            
            
            foreach ($data->employee_payslip_component as $detail) {

                switch (strtolower($detail->component_detail->component_name)) {

                    case 'basic':

                        $basic = $detail->amount;

                        break;
                    case 'hra':

                        $hra = $detail->amount;

                        break;
                    case 'convience allowance':

                        $convience = $detail->amount;

                        break;
                    case 'bonus':

                        $bonus = $detail->amount;
                        

                        break;

                    case 'fixed allowance':

                        $fixed_allowance = $detail->amount;


                        break;

                    case 'medical insurance':

                        $medical_allowance = $detail->amount;

                        break;
                    case 'pf employee':

                        $pf_employee = $detail->amount;
                        

                        break;

                    case 'pf employer':

                        $pf_employer = $detail->amount;

                        break;
                }
            }

        }
        
            $employee_object = $salary_group;
            $released_date = $data->released_date ?? "";
            $employee_id = Auth::id();
            $basic = round($basic, 2);
            $hra = round($hra, 2);
            $convience = round($convience, 2);
            $bonus = round($bonus, 2);
            $fixed_allowance = round($fixed_allowance, 2);
            $medical_insurance = $medical_allowance;
            $pf_employee = $pf_employee;
            $pf_employer = $pf_employer;
            $total_deduction = $total_deduction ?? "";
            $in_hand_salary = round($in_hand_salary, 2) ;
            $gross_salary = round($gross_salary, 2);
            $is_available = $is_available;
        
        return view('admin.payroll.individual_payslip', compact('data','released_date', 'employee_id', 'employee_object', 'gross_salary','in_hand_salary', 'basic','hra','is_available',
                                                                            'convience','bonus','fixed_allowance', 'total_deduction', 'medical_insurance', 'pf_employer', 'pf_employee'));
    }

    public function getPayPeriodData(Request $request){

        $date = $request->input('date'); // e.g., "2024-05" or "May 2024"
        [$year, $month] = explode('-', $date);
        $user_id = Auth::id();
        $employee = Employee::where('employee_id', $user_id)->first(['id']);

        $exist = EmployeePayslip::where('employee_id', $employee->id)->whereYear('released_date', $year)->whereMonth('released_date', $month)->latest('id')->first();
    
        $basic = 0;
        $hra =  0;
        $convience = 0;
        $bonus = 0;
        $fixed_allowance = 0;
        $medical_allowance = 0;
        $pf_employee = 0;
        $pf_employer = 0;
        $is_available = 0;
        $in_hand_salary = 0;
        $gross_salary = 0;
        $total_deduction = 0;
        $data =  [];
        if ($exist) {
            $is_available = 1;
            $data = EmployeePayslip::with(['employee_payslip_component'=>function($query){
                return $query->with(['component_detail']);
            }])->where('employee_id', $employee->id)->whereYear('released_date', $year)->whereMonth('released_date', $month)->first();

            $total_deduction = $data->total_deduction;
            $gross_salary = $data->gross_salary;
            $in_hand_salary = $gross_salary - $total_deduction;
    
            
            
            foreach ($data->employee_payslip_component as $detail) {

                switch (strtolower($detail->component_detail->component_name)) {

                    case 'basic':

                        $basic = $detail->amount;

                        break;
                    case 'hra':

                        $hra = $detail->amount;

                        break;
                    case 'convience allowance':

                        $convience = $detail->amount;

                        break;
                    case 'bonus':

                        $bonus = $detail->amount;
                        

                        break;

                    case 'fixed allowance':

                        $fixed_allowance = $detail->amount;


                        break;

                    case 'medical insurance':

                        $medical_allowance = $detail->amount;

                        break;
                    case 'pf employee':

                        $pf_employee = $detail->amount;
                        

                        break;

                    case 'pf employer':

                        $pf_employer = $detail->amount;

                        break;
                }
            }

        }
        
            // $employee_object = $salary_group;
            $released_date = $data->released_date ?? "";
            $basic = round($basic, 2);
            $hra = round($hra, 2);
            $convience = round($convience, 2);
            $bonus = round($bonus, 2);
            $fixed_allowance = round($fixed_allowance, 2);
            $medical_insurance = $medical_allowance;
            $pf_employee = $pf_employee;
            $pf_employer = $pf_employer;
            $total_deduction = $total_deduction ?? "";
            $in_hand_salary = round($in_hand_salary, 2) ;
            $gross_salary = round($gross_salary, 2);
            $is_available = $is_available;


        return response()->json(['is_available'=>$is_available, 'released_date' => $released_date, 'basic'=>$basic, 'hra' => $hra, 'convience'=>$convience, 'bonus'=>$bonus,
                                'fixed_allowance'=>$fixed_allowance, 'medical_insurance'=> $medical_insurance, 'pf_employee'=>$pf_employee, 'pf_employer' =>$pf_employer,
                                'total_deduction'=> $total_deduction,'in_hand_salary' => $in_hand_salary, 'gross_salary'=>$gross_salary ]);

    }


    public function employee_payslip_pdf(Request $request)
    {

        if ($request->has('month')) {
            $date_month = explode('-', $request->month);
            $year = $date_month[0];
            $month = (int) $date_month[1];
        } else {
            $year = Carbon::now()->year;
            $month = Carbon::now()->month;
        }


        $current_date = now();
        $employee_id = Auth::id();
        $salary_group = Employee::with(['department_name', 'job_title_details'])->where('employee_id', Auth::id())->first();

        $exist = EmployeePayslip::where('employee_id', $salary_group->id)->where('year', $year)->where('current_month', $month)->latest('id')->first();


        if (!$exist) {
            return response()->json(['status' => false, 'message' => 'Payslip not found for the selected date']);
        }

        $basic = 0;
        $hra =  0;
        $convience = 0;
        $bonus = 0;
        $fixed_allowance = 0;
        $medical_allowance = 0;
        $pf_employee = 0;
        $pf_employer = 0;
        $is_available = 0;
        $in_hand_salary = 0;
        $gross_salary = 0;
        $total_deduction = 0;
        $data =  [];
        if ($exist) {

            $is_available = 1;
            $data = EmployeePayslip::with(['employee_payslip_component' => function ($query) {
                return $query->with(['component_detail']);
            }])->where('employee_id', $salary_group->id)->where('year', $year)->where('current_month', $month)->latest('id')->first();


            //   dd(json_encode($data,JSON_PRETTY_PRINT));


            $total_deduction = $data->total_deduction;
            $gross_salary = $data->gross_salary;
            $in_hand_salary = $gross_salary - $total_deduction;

            foreach ($data->employee_payslip_component as $detail) {

                switch (strtolower($detail->component_detail->component_name)) {

                    case 'basic':

                        $basic = $detail->amount;

                        break;
                    case 'hra':

                        $hra = $detail->amount;

                        break;
                    case 'convience allowance':

                        $convience = $detail->amount;

                        break;
                    case 'bonus':

                        $bonus = $detail->amount;


                        break;

                    case 'fixed allowance':

                        $fixed_allowance = $detail->amount;


                        break;

                    case 'medical insurance':

                        $medical_allowance = $detail->amount;

                        break;
                    case 'pf employee':

                        $pf_employee = $detail->amount;


                        break;

                    case 'pf employer':

                        $pf_employer = $detail->amount;

                        break;
                }
            }
        }


        $employee_object = $salary_group;
        $released_date = $data->released_date ?? "";
        $employee_id = Auth::id();
        $basic = round($basic, 2);
        $hra = round($hra, 2);
        $convience = round($convience, 2);
        $bonus = round($bonus, 2);
        $fixed_allowance = round($fixed_allowance, 2);
        $medical_insurance = $medical_allowance;
        $pf_employee = $pf_employee;
        $pf_employer = $pf_employer;
        $total_deduction = $total_deduction ?? "";
        $in_hand_salary = round($in_hand_salary, 2);
        $gross_salary = round($gross_salary, 2);
        $is_available = $is_available;

        $monthName = Carbon::create()->month($month)->format('F'); // Get full month name
        $pdf = Pdf::loadView('pdf.employee_payslip_pdf', compact('year', 'monthName', 'employee_object', 'basic', 'hra', 'convience', 'bonus', 'fixed_allowance', 'total_deduction', 'medical_insurance', 'pf_employer', 'pf_employee', 'gross_salary', 'in_hand_salary'));

        return $pdf->download("payslip_{$year}_{$monthName}.pdf");
    }


    public function payslip_excel_export(Request $request)
    {
        if ($request->has('month')) {
            $date_month = explode('-', $request->month);
            $year = $date_month[0];
            $month = (int) $date_month[1];
        } else {
            $year = Carbon::now()->year;
            $month = Carbon::now()->month;
        }

        $salary_group = Employee::with(['department_name', 'job_title_details'])->where('employee_id', Auth::id())->first();
        $exist = EmployeePayslip::where('employee_id', $salary_group->id)->where('year', $year)->where('current_month', $month)->latest('id')->first();

        if (!$exist) {
            return response()->json(['status' => false, 'message' => 'Payslip Not found for your selected date']);
        }

        $monthName = Carbon::create()->month($month)->format('F'); // Get full month name

        return Excel::download(new EmployeePayslipExcel($salary_group, $exist, $year, $month, $monthName),  "employeePayslip{$year}_{$monthName}.xlsx");
    }
 
}
