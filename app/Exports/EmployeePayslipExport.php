<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithColumnWidths; // Import this





class EmployeePayslipExport implements FromCollection, WithHeadings, WithStrictNullComparison, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    // // Define the static data
    // $data = [
    //     [
    //         'Serial' => 'ASJASD11',
    //         'Purchase date' => '2024-06-12',
    //     ],
        
    // ];
    // return new Collection($data);   
    // }
    protected $data;


    public function columnWidths(): array
    {
        return [
            'A' => 12,  // CAT
            'B' => 12,  // MAST
            'C' => 30,  // Names and Surnames
            'D' => 25,  // FUNCTIONS
            'E' => 25,  // AGENCIES
            'F' => 18,  // Basic Salary
            'G' => 18,  // Overpayment
            'H' => 22,  // Good Separation Bonus
            'I' => 22,  // PES Separation Allowance
            'J' => 18,  // Absence
            'K' => 22,  // Responsibility Bonus
            'L' => 22,  // Seniority Bonus
            'M' => 22,  // Attendance Bonus
            'N' => 25,  // Performance bonus/Function compensation
            'O' => 22,  // Cash Bonus
            'P' => 22,  // Housing Allowance
            'Q' => 22,  // Transport Allowance
            'R' => 18,  // Electricity
            'S' => 18,  // Water
            'T' => 22,  // Cost Of Representation
            'U' => 22,  // Milk Bonus
            'V' => 22,  // Dirt Premium
            'W' => 18,  // Domestic
            'X' => 18,  // Water
            'Y' => 18,  // Food
            'Z' => 18,  // 13th Month
            'AA' => 18, // LEAVE
            'AB' => 25, // Gross Salary
            'AC' => 25, // Taxable Salary
            'AD' => 25, // Contributable Salary
            'AE' => 25, // Capped Contributory Salary
            'AF' => 15, // Extra 1
            'AG' => 22, // IRPP Calculated
            'AH' => 15, // Var
            'AI' => 18, // IRPP c
            'AJ' => 18, // CAC c
            'AK' => 18, // TDL c
            'AL' => 15, // VAR
            'AM' => 18, // TDL c
            'AN' => 18, // CFC c
            'AO' => 18, // RAV c
            'AP' => 15, // VAR
            'AQ' => 18, // RAV c
            'AR' => 18, // SOCIAL (PVI c)
            'AS' => 18, // CFC
            'AT' => 18, // FNE
            'AU' => 18, // PVI
            'AV' => 18, // ALLOC
            'AW' => 18, // A T
            'AX' => 18, // Extra 2
            'AY' => 18, // Mutual
            'AZ' => 18, // Salary advance
            'BA' => 18, // School credit
            'BB' => 18, // EMERGENCY LOAN
            'BC' => 18, // ORDINARY P. LOAN
            'BD' => 18, // CAR LOAN
            'BE' => 18, // Ascoma
            'BF' => 18, // Rolling equipment credit
            'BG' => 18, // Salary deduction
            'BH' => 18, // Notice due by the employee
            'BI' => 18, // REGUL IRPP 2017
            'BJ' => 18, // REGUL CAC 2017
            'BK' => 25, // Net To Pay
        ];
    }

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        if (!$this->data) {
            return new Collection([]); // Agar data nahi mila to empty sheet return karein
        }
        return new Collection([
            [
                //Identification
             $this->data->employee->employee_payslip_category->category_name,
             '0011',
             $this->data->employee->first_name." ".$this->data->employee->last_name,
             $this->data->employee->department_name->department,
             $this->data->employee->division->name,
             // Main Salary
             $this->data->basic_salary, 
             $this->data->overpayment, 
             $this->data->good_seperation_bonus, 
             $this->data->pes_seperation_allowance, 
             $this->data->absence,
             //BONUSES AND OTHER CASH BENEFITS
             $this->data->responsibility_bonus, 
             $this->data->seniority_bonus, 
             $this->data->attendance_bonus, 
             $this->data->performance_bonus, 
             $this->data->cash_bonus,
             $this->data->housing_allowance,  
             $this->data->transport_allowance, 
             $this->data->electricity, 
             $this->data->water,
             // Reimbusemen pof expenses
             $this->data->cost_of_representation, 
             $this->data->milk_bonus, 
             $this->data->dirt_premium,
             // Benefits in kind
             $this->data->domestic, 
             $this->data->benefit_water, 
             $this->data->food,

             $this->data->month, 
             $this->data->hrms_leave, 
             $this->data->gross_salary, 
             $this->data->taxable_salary, 
             $this->data->contributable_salary_np, 
             $this->data->capped_contributory_salary,
             $this->data->extra1,
             $this->data->irpp_calculated,
             0,

             //tax
             $this->data->irpp_calculated,
             $this->data->cac_calculated,
             $this->data->tdl_calculated,
             0,
             $this->data->tdl_calculated,
             $this->data->cfc_calculated,
             $this->data->rav_calculated,
             0,
             $this->data->rav_calculated,

             //Social
             $this->data->social,

             //Employer Deduction (TAX)
             $this->data->cfc,
             $this->data->fne,

             //Employer Deduction (Social)
             $this->data->pvi,
             $this->data->alloc,
             $this->data->at,

             $this->data->extra2,

             $this->data->mutual, 
             $this->data->salary_advance, 
             $this->data->school_credit, 
             $this->data->emergency_loan, 
             $this->data->ordinary_p_loan, 
             $this->data->car_loan,
             $this->data->ascoma,
             $this->data->rolling_equipment_credit,
             $this->data->salary_deduction,
             $this->data->notice_due_by_the_employee,
             $this->data->regul_irpp_2017,
             $this->data->regul_cac_2017,

             $this->data->net_to_pay,
            ],
           
        ]);
    }


    public function headings(): array
    {
        return [
            ['ABC Finance', '', '', '', '', '', '', '', '', '', ''],
            ['IDENTIFICATION', '', '', '', '', 
            'MAIN SALARY', '', '', '', '',
             'BONUSES AND OTHER CASH BENEFITS','','','','','','','','',
            'Reimbursement OF EXPENSES','','',
             'BENEFITS IN KIND', '', '',
             '','','','','','','','','',
             'TAX (SALARY DEDUCTIONS)',
            '',
            // 'Employer Deduction (TAX)','',
            // 'Employer Deduction (Social)', '', '',
            // '',
            ],
            ['CAT', 'MAST', 'Names and Surnames', 'FUNCTIONS', 'AGENCIES',
             'Basic Salary', 'Overpayment', 'Good Separation Bonus', 'PES Separation Allowance', 'Absence',
             'Responsibility Bonus', 'Seniority Bonus', 'Attendance Bonus', 'Performance bonus/Function compensation', 'Cash Bonus', 'Housing Allowance', 'Transport Allowance', 'Electricity', 'Water',
             'Cost Of Representation', 'Milk Bonus', 'Dirt Premium',
             'Domestic', 'Water', 'Food',
             '13th Month', 'LEAVE','Gross Salary', 'Taxable Salary', 'Contributable Salary', 'Capped Contributory Salary','','IRPP Calculated','Var',
             'IRPP c', 'CAC c', 'TDL c', 'VAR', 'TDL c', 'CFC c', 'RAV c', 'VAR', 'RAV c',
             'SOCIAL (PVI c)',
             'CFC', 'FNE',
             'PVI','ALLOC','A T',
             '',
             'Mutual','Salary advance', 'School credit', 'EMERGENCY LOAN', 'ORDINARY P. LOAN', 'CAR LOAN', 'Ascoma','Rolling equipment credit', 'Salary deduction', 'Notice due by the employee','REGUL IRPP 2017','REGUL CAC 2017',
             'Net To Pay'
              ], 
        ];
    }


    public function styles(Worksheet $sheet)
    {
        // Merge cells for headers
        $sheet->mergeCells('A1:E1'); // Identification
        $sheet->mergeCells('F1:J1'); // Main Salary
        $sheet->mergeCells('K1:R1'); // Bonuses
        $sheet->mergeCells('S1:U1'); // Reimbursement
        $sheet->mergeCells('V1:X1'); // Benefits
        $sheet->mergeCells('Y1:AE1'); // Additional Info
        $sheet->mergeCells('AF1:AH1'); // Tax
    
        // Bold and center headers
        $sheet->getStyle('A1:AH2')->getFont()->setBold(true);
        $sheet->getStyle('A1:AH1')->getAlignment()->setHorizontal('center');
    }

}
