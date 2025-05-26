<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmployeePayslipExport;
use App\Exports\SinglePayslipExport;
use App\Http\Controllers\Controller;
use App\Models\EmployeePayslip;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;



class ExportController extends Controller
{
    public function exportPayslipExport(Request $request){

        $employee_id = $request->employee_id;
        $monthYear =  $request->filterData;
        $year = Carbon::now()->year; 
        $month = Carbon::now()->month; 

        if(!$monthYear){
            $current_year = $year; 
            $current_month = $month;
        }else{
            $date_month = explode('-', $monthYear);
            $current_year = (int)$date_month[0]; 
            $current_month = (int)$date_month[1];
        }

        $data = EmployeePayslip::with(['employee' => function ($query) {
            $query->select('id', 'employee_id', 'first_name', 'last_name', 'travel_category_allowance_id', 'department', 'division_id', 'registration_no', 'cnps_no', 'niu')
                  ->with([
                      'employee_payslip_category' => function ($query) { // Fixed parameter name
                          $query->select('id', 'category_name');
                      },
                      'department_name' => function ($query) { // Fixed syntax
                          $query->select('id', 'department');
                      },
                      'division' => function($query){
                            $query->select('id', 'name');
                      }
                  ]);
        }])
        ->where('employee_id', $employee_id)
          ->where('year', $current_year)
          ->where('current_month', $current_month)
          ->first();
        

       if(empty($data)){
        return Redirect::back()->withErrors(['msg' => 'Payslip not found']);
    }
        $monthName = Carbon::create()->month($current_month)->format('F'); // Get full month name
        return Excel::download(new SinglePayslipExport($data),  "payslip_{$current_year}_{$monthName}.xlsx");
    }


    public function exportPayslipExportPdf(Request $request){

        $employee_id = $request->employee_id;
        $monthYear =  $request->filterData;
        $year = Carbon::now()->year; 
        $month = Carbon::now()->month; 

        if(!$monthYear){
            $current_year = $year; 
            $current_month = $month;
        }else{
            $date_month = explode('-', $monthYear);
            $current_year = (int)$date_month[0]; 
            $current_month = (int)$date_month[1];
        }

        $employee_data = EmployeePayslip::with(['employee' => function ($query) {
            $query->select('id', 'employee_id', 'first_name', 'last_name', 'travel_category_allowance_id', 'department', 'division_id', 'registration_no', 'cnps_no', 'niu')
                  ->with([
                      'employee_payslip_category' => function ($query) { // Fixed parameter name
                          $query->select('id', 'category_name');
                      },
                      'department_name' => function ($query) { // Fixed syntax
                          $query->select('id', 'department');
                      },
                      'division' => function($query){
                            $query->select('id', 'name');
                      }
                  ]);
        }])
        ->where('employee_id', $employee_id)
          ->where('year', $current_year)
          ->where('current_month', $current_month)
          ->first();
        
         
       if(empty($employee_data)){
            return Redirect::back()->withErrors(['msg' => 'Payslip not found']);
        }

        $monthName = Carbon::create()->month($month)->format('F'); // Get full month name
        $pdf = Pdf::loadView('pdf.individual_monthly_payslip', compact('employee_data', 'year', 'monthName'));
    
        return $pdf->download("payslip_{$year}_{$monthName}.pdf");

    }
}
