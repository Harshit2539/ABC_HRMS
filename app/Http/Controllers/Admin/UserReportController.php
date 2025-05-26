<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AccumulatedPayslipExport;
use App\Exports\payslipBulkExport;
use App\Exports\PayslipExport;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\EmployeeLoans;
use App\Models\EmployeePayslip;
use App\Models\TravelRecords;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Log;

class UserReportController extends Controller
{
  public function userReports_list()
  {
    return view('admin.userReport.report_list');
  }

  public function travel_request_report(Request $request)
  {
    $startDate = $request->start_date;
    $endDate = $request->end_date;
    $status = $request->status;

    $data = TravelRecords::with('employee', 'currency')
      ->when($startDate, function ($query) use ($startDate) {
        return $query->whereDate('travel_date', '>=', $startDate);
      })
      ->when($endDate, function ($query) use ($endDate) {
        return $query->whereDate('travel_date', '<=', $endDate);
      })
      ->when($status, function ($query) use ($status) {
        return $query->where('status', $status);
      })
      ->get();


    if ($request->ajax()) {
      return DataTables::of($data)
        ->addColumn('employee_id', function ($data) {
          return $data->employee->name;
        })
        ->addColumn('type', function ($data) {
          return $data->type;
        })
        ->addColumn('purpose', function ($data) {
          return $data->purpose;
        })
        ->addColumn('travel_from', function ($data) {
          return $data->travel_from;
        })
        ->addColumn('travel_to', function ($data) {
          return $data->travel_to;
        })
        ->addColumn('travel_date', function ($data) {
          return date("d-M-Y", strtotime($data->travel_date));
        })
        ->addColumn('return_date', function ($data) {
          return date("d-M-Y", strtotime($data->return_date));
        })
        ->addColumn('notes', function ($data) {
          if (!empty($data->notes)) {
            return $data->notes;
          }
        })
        ->addColumn('funding_with_currency', function ($data) {
          $currencyName = $data->currency ? $data->currency->code : '';
          $funding = $data->funding ?? '0';
          return $funding . $currencyName;
        })
        ->addColumn('status', function ($data) {
          return $data->status;
        })
        ->addColumn('created_at', function ($data) {
          return date("d-M-Y", strtotime($data->created_at));
        })
        ->addColumn('updated_at', function ($data) {
          return date("d-M-Y", strtotime($data->updated_at));
        })
        ->make(true);
    }
    return view('admin.userReport.travelRequestReport');
  }

  public function Employee_loan_report(Request $request)
  {
    $startDate = $request->start_date;
    $endDate = $request->end_date;
    $status = $request->status;

    $data = EmployeeLoans::with('employee', 'loan', 'currency')
      ->when($startDate, function ($query) use ($startDate) {
        return $query->whereDate('start_date', '>=', $startDate);
      })
      ->when($endDate, function ($query) use ($endDate) {
        return $query->whereDate('last_installment_date', '<=', $endDate);
      })
      ->when($status, function ($query) use ($status) {
        return $query->where('status', $status);
      })
      ->get();


    if ($request->ajax()) {
      return DataTables::of($data)
        ->addColumn('employee_id', function ($data) {
          return $data->employee->name;
        })
        ->addColumn('loan_id', function ($data) {
          return $data->loan->name;
        })
        ->addColumn('start_date', function ($data) {
          return date("d-M-Y", strtotime($data->start_date));
        })
        ->addColumn('last_installment_date', function ($data) {
          return date("d-M-Y", strtotime($data->last_installment_date));
        })

        ->addColumn('period_months', function ($data) {
          return $data->period_months;
        })
        ->addColumn('amount', function ($data) {
          return $data->amount;
        })
        ->addColumn('monthly_installment', function ($data) {
          return $data->monthly_installment;
        })

        ->addColumn('funding_with_currency', function ($data) {
          $currencyName = $data->currency ? $data->currency->code : '';
          $funding = $data->funding ?? '0';
          return $funding . $currencyName;
        })
        ->addColumn('status', function ($data) {
          return $data->status;
        })
        ->addColumn('details', function ($data) {
          return $data->details;
        })
        ->addColumn('approver1', function ($data) {
          return $data->is_reject;
        })
        ->make(true);
    }
    return view('admin.userReport.loanRequestReport');
  }

  public function attendance_request_report(Request $request)
  {
    $in_time = $request->in_time;
    $out_time = $request->out_time;
    $employee = $request->employee;




    $data = Attendance::with('employeeAtt')
      ->when($in_time, function ($query) use ($in_time) {
        return $query->whereDate('in_time', '>=', $in_time);
      })
      ->when($out_time, function ($query) use ($out_time) {
        return $query->whereDate('out_time', '<=', $out_time);
      })


      ->when($employee, function ($query) use ($employee) {
        return $query->whereHas('employeeAtt', function ($query) use ($employee) {
          $query->where('name', $employee);
        });
      })

      ->get();

    $attendance = User::select('id', 'name')->where('role_name', 'Employee')->get();

    if ($request->ajax()) {
      return DataTables::of($data)
        ->addColumn('employee', function ($data) {
          return $data->employeeAtt->name;
        })
        ->addColumn('in_time', function ($data) {
          return date("d-M-Y", strtotime($data->in_time));
        })

        ->addColumn('out_time', function ($data) {
          return date("d-M-Y", strtotime($data->out_time));
        })

        ->addColumn('note', function ($data) {
          if (!empty($data->note)) {
            return $data->note;
          }
        })

        ->addColumn('image_in', function ($user) {
          $imageUrl = asset('storage/' . $user->profile_image);
          return '<img src="' . $imageUrl . '" width="50" height="50">';
        })
        ->rawColumns(['image_in']) // Render HTML in the column


        ->addColumn('image_out', function ($user) {
          $imageUrl = asset('storage/' . $user->profile_image);
          return '<img src="' . $imageUrl . '" width="50" height="50">';
        })
        ->rawColumns(['image_out']) // Render HTML in the column


        ->addColumn('map_lat', function ($data) {
          return $data->map_lat;
        })

        ->addColumn('map_lng', function ($data) {
          return $data->map_lng;
        })

        ->addColumn('map_snapshot', function ($data) {
          return $data->map_snapshot;
        })
        ->addColumn('map_out_lat', function ($data) {
          return $data->map_out_lat;
        })

        ->addColumn('map_out_lng', function ($data) {
          return $data->map_out_lng;
        })

        ->addColumn('map_out_snapshot', function ($data) {
          return $data->map_out_snapshot;
        })

        ->addColumn('in_ip', function ($data) {
          return $data->in_ip;
        })

        ->addColumn('out_ip', function ($data) {
          return $data->out_ip;
        })



        ->addColumn('created_at', function ($data) {
          return date("d-M-Y", strtotime($data->created_at));
        })
        ->addColumn('updated_at', function ($data) {
          return date("d-M-Y", strtotime($data->updated_at));
        })
        ->make(true);
    }
    return view('admin.userReport.attendanceReport', compact('data', 'attendance'));
  }


  public function payslip_report(Request $request)
  {

    // $year = Carbon::now()->year; 
    // $month = Carbon::now()->month; 
    // $data = EmployeePayslip::with('employee')->where('year',$year)->where('current_month', $month)->get();


    $selectedMonth = $request->input('start'); // Expected format: YYYY-MM
    if ($selectedMonth) {
      [$year, $month] = explode('-', $selectedMonth);
    } else {
      $year = Carbon::now()->year;
      $month = Carbon::now()->month;
    }


    $data = EmployeePayslip::with('employee')
      ->where('year', (int)$year)
      ->where('current_month', (int)$month)
      ->get();

    if ($request->ajax()) {
      return DataTables::of($data)
        ->addColumn('employee_id', function ($data) {
          return ($data->employee->first_name . '' . $data->employee->last_name) ?? '';
        })
        ->addColumn('functions', function ($data) {
          return 'COM';
        })
        ->addColumn('agencies', function ($data) {
          return 'ACACIA';
        })
        ->addColumn('basic_salary', function ($data) {
          return ($data->basic_salary) ?? '-';
        })
        ->addColumn('overpayment', function ($data) {
          return ($data->overpayment) ?? '-';
        })
        ->addColumn('good_seperation_bonus', function ($data) {
          return ($data->good_seperation_bonus) ?? '-';
        })
        ->addColumn('pes_seperation_allowance', function ($data) {
          return ($data->pes_seperation_allowance) ?? '-';
        })
        ->addColumn('absence', function ($data) {
          return ($data->absence) ?? '-';
        })

        ->addColumn('responsibility_bonus', function ($data) {
          return ($data->responsibility_bonus) ?? '-';
        })
        ->addColumn('seniority_bonus', function ($data) {
          return ($data->seniority_bonus) ?? '-';
        })
        ->addColumn('attendance_bonus', function ($data) {
          return ($data->attendance_bonus) ?? '-';
        })
        ->addColumn('performance_bonus', function ($data) {
          return ($data->performance_bonus) ?? '-';
        })
        ->addColumn('cash_bonus', function ($data) {
          return ($data->cash_bonus) ?? '-';
        })
        ->addColumn('housing_allowance', function ($data) {
          return ($data->housing_allowance) ?? '-';
        })
        ->addColumn('transport_allowance', function ($data) {
          return ($data->transport_allowance) ?? '-';
        })
        ->addColumn('electricity', function ($data) {
          return ($data->electricity) ?? '-';
        })
        ->addColumn('water', function ($data) {
          return ($data->water) ?? '-';
        })
        ->addColumn('cost_of_representation', function ($data) {
          return ($data->cost_of_representation) ?? '-';
        })
        ->addColumn('milk_bonus', function ($data) {
          return ($data->milk_bonus) ?? '-';
        })
        ->addColumn('dirt_premium', function ($data) {
          return ($data->dirt_premium) ?? '-';
        })
        ->addColumn('domestic', function ($data) {
          return ($data->domestic) ?? '-';
        })
        ->addColumn('benefit_water', function ($data) {
          return ($data->benefit_water) ?? '-';
        })
        ->addColumn('food', function ($data) {
          return ($data->food) ?? '-';
        })
        ->addColumn('month', function ($data) {
          return ($data->month) ?? '-';
        })
        ->addColumn('hrms_leave', function ($data) {
          return ($data->hrms_leave) ?? '-';
        })
        ->addColumn('mutual', function ($data) {
          return ($data->mutual) ?? '-';
        })
        ->addColumn('salary_advance', function ($data) {
          return ($data->salary_advance) ?? '-';
        })
        ->addColumn('school_credit', function ($data) {
          return ($data->school_credit) ?? '-';
        })
        ->addColumn('emergency_loan', function ($data) {
          return ($data->emergency_loan) ?? '-';
        })
        ->addColumn('ordinary_p_loan', function ($data) {
          return ($data->ordinary_p_loan) ?? '-';
        })
        ->addColumn('car_loan', function ($data) {
          return ($data->car_loan) ?? '-';
        })
        ->addColumn('ascoma', function ($data) {
          return ($data->ascoma) ?? '-';
        })
        ->addColumn('rolling_equipment_credit', function ($data) {
          return ($data->rolling_equipment_credit) ?? '-';
        })
        ->addColumn('salary_deduction', function ($data) {
          return ($data->salary_deduction) ?? '-';
        })



        ->addColumn('notice_due_by_the_employee', function ($data) {
          return ($data->notice_due_by_the_employee) ?? '-';
        })
        ->addColumn('regul_irpp_2017', function ($data) {
          return ($data->regul_irpp_2017) ?? '-';
        })
        ->addColumn('regul_cac_2017', function ($data) {
          return ($data->regul_cac_2017) ?? '-';
        })
        ->addColumn('gross_salary', function ($data) {
          return ($data->gross_salary) ?? '-';
        })
        ->addColumn('contributable_salary_np', function ($data) {
          return ($data->contributable_salary_np) ?? '-';
        })
        ->addColumn('extra1', function ($data) {
          return ($data->extra1) ?? '-';
        })
        ->addColumn('cac_calculated', function ($data) {
          return ($data->cac_calculated) ?? '-';
        })
        ->addColumn('cfc_calculated', function ($data) {
          return ($data->cfc_calculated) ?? '-';
        })
        ->addColumn('social', function ($data) {
          return ($data->social) ?? '-';
        })
        ->addColumn('fne', function ($data) {
          return ($data->fne) ?? '-';
        })
        ->addColumn('alloc', function ($data) {
          return ($data->alloc) ?? '-';
        })
        ->addColumn('extra2', function ($data) {
          return ($data->extra2) ?? '-';
        })
        ->addColumn('taxable_salary', function ($data) {
          return ($data->taxable_salary) ?? '-';
        })
        ->addColumn('capped_contributory_salary', function ($data) {
          return ($data->capped_contributory_salary) ?? '-';
        })
        ->addColumn('irpp_calculated', function ($data) {
          return ($data->irpp_calculated) ?? '-';
        })
        ->addColumn('tdl_calculated', function ($data) {
          return ($data->tdl_calculated) ?? '-';
        })
        ->addColumn('rav_calculated', function ($data) {
          return ($data->rav_calculated) ?? '-';
        })

        ->addColumn('cfc', function ($data) {
          return ($data->cfc) ?? '-';
        })
        ->addColumn('pvi', function ($data) {
          return ($data->pvi) ?? '-';
        })
        ->addColumn('at', function ($data) {
          return ($data->at) ?? '-';
        })
        ->addColumn('net_to_pay', function ($data) {
          return ($data->net_to_pay) ?? '-';
        })


        ->make(true);
    }
    return view('admin.userReport.payslip_report');
  }

  public function payslip_export(Request $request)
  {
    if ($request->has('month')) {
      $date_month = explode('-', $request->month);
      $year = $date_month[0];
      $month = $date_month[1];
    } else {
      $year = Carbon::now()->year;
      $month = Carbon::now()->month;
    }

    $is_data = EmployeePayslip::where('year', (int)$year)->where('current_month', (int)$month)->count();
    if ($is_data == 0) {
      return response()->json(['error' => 'Payslip not found for the selected date'], 404);
    }
    return Excel::download(new PayslipExport($year, $month), 'payslipExport.xlsx');
  }


  public function employee_payslip_report(Request $request)
  {

    $year = Carbon::now()->year;
    $month = Carbon::now()->month;
    $data = EmployeePayslip::with('employee')->where('year', $year)->where('current_month', $month)->get();


    if ($request->ajax()) {
      return DataTables::of($data)
        ->addColumn('employee_id', function ($data) {
          return ($data->employee->first_name . '' . $data->employee->last_name) ?? '';
        })
        ->addColumn('functions', function ($data) {
          return 'COM';
        })
        ->addColumn('agencies', function ($data) {
          return 'ACACIA';
        })
        ->addColumn('basic_salary', function ($data) {
          return ($data->basic_salary) ?? '-';
        })
        ->addColumn('overpayment', function ($data) {
          return ($data->overpayment) ?? '-';
        })
        ->addColumn('good_seperation_bonus', function ($data) {
          return ($data->good_seperation_bonus) ?? '-';
        })
        ->addColumn('pes_seperation_allowance', function ($data) {
          return ($data->pes_seperation_allowance) ?? '-';
        })
        ->addColumn('absence', function ($data) {
          return ($data->absence) ?? '-';
        })

        ->make(true);
    }
    return view('admin.userReport.employees_payslip_export');
  }

  public function employee_payslip_export(Request $request)
  {

    if ($request->has('month')) {
      $date_month = explode('-', $request->month);
      $year = $date_month[0];
      $month = $date_month[1];
    } else {
      $year = Carbon::now()->year;
      $month = Carbon::now()->month;
    }


    $data = EmployeePayslip::with(['employee' => function ($query) {
      $query->select('id', 'employee_id', 'first_name', 'last_name', 'travel_category_allowance_id', 'department', 'division_id', 'confirmation_date', 'registration_no', 'cnps_no', 'niu')
        ->with([
          'employee_payslip_category' => function ($query) { // Fixed parameter name
            $query->select('id', 'category_name');
          },
          'department_name' => function ($query) { // Fixed syntax
            $query->select('id', 'department');
          },
          'division' => function ($query) {
            $query->select('id', 'name');
          }
        ]);
    }])
      ->where('year', (int)$year)
      ->where('current_month', (int)$month)
      ->get();

    if (count($data) == 0) {
      return response()->json(['status' => false, 'error' => 'Payslip not found for the selected date'], 404);
    }

    // return Excel::download(new EmployeePayslipExport($data), 'payslip.xlsx');
    $monthName = Carbon::create()->month($month)->format('F'); // Get full month name

    return Excel::download(new payslipBulkExport($data),  "payslip_{$year}_{$monthName}.xlsx");
  }


  public function employee_payslip_export_pdf(Request $request)
  {
    if ($request->has('month')) {
      $date_month = explode('-', $request->month);
      $year = $date_month[0];
      $month = $date_month[1];
    } else {
      $year = Carbon::now()->year;
      $month = Carbon::now()->month;
    }

    $employee_data = EmployeePayslip::with(['employee' => function ($query) {
      $query->select('id', 'employee_id', 'first_name', 'last_name', 'travel_category_allowance_id', 'department', 'division_id', 'confirmation_date', 'registration_no', 'cnps_no', 'niu')
        ->with([
          'employee_payslip_category' => function ($query) {
            $query->select('id', 'category_name');
          },
          'department_name' => function ($query) {
            $query->select('id', 'department');
          },
          'division' => function ($query) {
            $query->select('id', 'name');
          }
        ]);
    }])
      ->where('year', (int)$year)
      ->where('current_month', (int)$month)
      ->get();

    if (count($employee_data) == 0) {
      return response()->json(['status' => false, 'error' => 'Payslip not found for the selected date'], 404);
    }



    $monthName = Carbon::create()->month($month)->format('F'); // Get full month name
    $pdf = Pdf::loadView('pdf.monthly_payslip', compact('employee_data', 'year', 'monthName'));

    return $pdf->download("payslip_{$year}_{$monthName}.pdf");
  }


  public function accumulatedPayslip_export(Request $request)
  {
    if ($request->has('startMonth') && $request->has('endMonth')) {

      $start_date_month = explode('-', $request->startMonth);
      $start_year = $start_date_month[0];
      $start_month = $start_date_month[1];

      $end_date_month = explode('-', $request->endMonth);
      $end_year = $end_date_month[0];
      $end_month = $end_date_month[1];
      $is_data = EmployeePayslip::whereBetween('year', [(int)$start_year, (int)$end_year])->whereBetween('current_month', [(int)$start_month, (int)$end_month])->count();

      if ($is_data == 0) {
        return response()->json(['error' => 'Payslips not found for the selected range'], 404);
      }
      return Excel::download(new AccumulatedPayslipExport($start_year, $start_month, $end_year, $end_month), 'accumulatedPayslipExport.xlsx');
    }
  }
}
