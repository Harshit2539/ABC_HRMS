<?php

namespace App\Exports;

use App\Models\EmployeePayslip;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PayslipExport implements FromView, WithStyles, ShouldAutoSize, WithColumnWidths
{

    protected $year;
    protected $month;
    
    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
        
    }


    public function view(): View
    {
        $employees = EmployeePayslip::with(['employee' => function ($query) {
            $query->select('id', 'employee_id', 'first_name', 'last_name', 'travel_category_allowance_id', 'department', 'division_id')
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
        ->where('year', (int)$this->year)->where('current_month', (int)$this->month)
          ->get();

          
        $totals = [
            'basic_salary' => $employees->sum('basic_salary'),
            'overpayment' => $employees->sum('overpayment'),
            'good_seperation_bonus' => $employees->sum('good_seperation_bonus'),
            'pes_seperation_allowance' => $employees->sum('pes_seperation_allowance'),
            'absence' => $employees->sum('absence'),


            'responsibility_bonus' => $employees->sum('responsibility_bonus'),
            'seniority_bonus' => $employees->sum('seniority_bonus'),
            'attendance_bonus' => $employees->sum('attendance_bonus'),
            'performance_bonus' => $employees->sum('performance_bonus'),
            'cash_bonus' => $employees->sum('cash_bonus'),

            'housing_allowance' => $employees->sum('housing_allowance'),
            'transport_allowance' => $employees->sum('transport_allowance'),
            'electricity' => $employees->sum('electricity'),
            'water' => $employees->sum('water'),
            'cost_of_representation' => $employees->sum('cost_of_representation'),

            'milk_bonus' => $employees->sum('milk_bonus'),
            'dirt_premium' => $employees->sum('dirt_premium'),
            'domestic' => $employees->sum('domestic'),
            'benefit_water' => $employees->sum('benefit_water'),
            'food' => $employees->sum('food'),

            'month' => $employees->sum('month'),
            'hrms_leave' => $employees->sum('hrms_leave'),
            'mutual' => $employees->sum('mutual'),
            'salary_advance' => $employees->sum('salary_advance'),
            'school_credit' => $employees->sum('school_credit'),
            'emergency_loan' => $employees->sum('emergency_loan'),
            'ordinary_p_loan' => $employees->sum('ordinary_p_loan'),
            'car_loan' => $employees->sum('car_loan'),
            'ascoma' => $employees->sum('ascoma'),
            'rolling_equipment_credit' => $employees->sum('rolling_equipment_credit'),
            'salary_deduction' => $employees->sum('salary_deduction'),
            'notice_due_by_the_employee' => $employees->sum('notice_due_by_the_employee'),
            'regul_irpp_2017' => $employees->sum('regul_irpp_2017'),
            'regul_cac_2017' => $employees->sum('regul_cac_2017'),
            'gross_salary' => $employees->sum('gross_salary'),


            'contributable_salary_np' => $employees->sum('contributable_salary_np'),
            'extra1' => $employees->sum('extra1'),
            'cac_calculated' => $employees->sum('cac_calculated'),
            'cfc_calculated' => $employees->sum('cfc_calculated'),
            'social' => $employees->sum('social'),
             'fne' => $employees->sum('fne'),
            'alloc' => $employees->sum('alloc'),
            'extra2' => $employees->sum('extra2'),
            'taxable_salary' => $employees->sum('taxable_salary'),
            'capped_contributory_salary' => $employees->sum('capped_contributory_salary'),
            'irpp_calculated' => $employees->sum('irpp_calculated'),
            'tdl_calculated' => $employees->sum('tdl_calculated'),
            'rav_calculated' => $employees->sum('rav_calculated'),
            'cfc' => $employees->sum('cfc'),
            'pvi' => $employees->sum('pvi'),
            'at' => $employees->sum('at'),
            'net_to_pay' => $employees->sum('net_to_pay'),

        ];

        return view('exports.payslip', compact('employees', 'totals'));
    }

  
    public function styles(Worksheet $sheet)
    {
        // Merge header cells for company details
        foreach (range(1, 5) as $row) {
            $sheet->mergeCells("A{$row}:BM{$row}");
        }
    
        // Styling header text
        $sheet->getStyle('A1:A5')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => ['horizontal' => 'left'],
        ]);
    
        // Column headers styling
        $sheet->getStyle('A10:BM10')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12],
            'alignment' => ['horizontal' => 'center'],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F2F2F2'],
            ]
        ]);
    
        // Borders for the data cells
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle("A10:BM{$highestRow}")->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        ]);
    }
    
    
    public function columnWidths(): array
    {
        return [
            'A' => 10, 
            'B' => 15, 
            'C' => 30, 
            'D' => 25,
            'E' => 20,
            'F' => 20,
            'G' => 20, 
            'H' => 25,  
            'I' => 25,
            'J' => 15,  
            'AU' => 15,
            'AV' => 15,
            'AW' => 15,
            'AX' => 15,
            'AY' => 15,

        ];
    }
}


