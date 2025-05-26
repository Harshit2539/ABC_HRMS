<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class payslipBulkExport implements FromView, WithStyles, ShouldAutoSize, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $employee_data = $this->data;
        return view('exports.employeepayslipbulkexport', compact('employee_data'));
    }

    public function styles(Worksheet $sheet)
    {
        
    }
    
    /**
     * Function to check if a row belongs to an employee (modify logic accordingly)
     */
    private function isEmployeeRow($sheet, $row)
    {
       
        $cellValue = $sheet->getCell("A{$row}")->getValue();
        return !empty($cellValue) && preg_match('/Employee/i', $cellValue);
    }
    
    public function columnWidths(): array
    {
        return [
        ];
    }
 
}
    // public function styles(Worksheet $sheet)
    //     {
    //         $sheet->mergeCells("A1:G1");
    //         $sheet->mergeCells("A2:C2");
    //         $sheet->mergeCells("D2:G2");
    //         $sheet->mergeCells("A3:C3");
    //         $sheet->mergeCells("D3:G3");
    //         $sheet->mergeCells("A4:C4");
    //         $sheet->mergeCells("D4:G4");
    //         $sheet->mergeCells("A5:G5");
        
    //         $sheet->getStyle('A1:A5')->applyFromArray([
    //             'font' => ['bold' => true, 'size' => 14],
    //             'alignment' => ['horizontal' => 'center'],
    //         ]);
        
    //         $sheet->getStyle('A7:I7')->applyFromArray([
    //             'font' => ['bold' => true, 'size' => 12],
    //             'alignment' => ['horizontal' => 'center'],
    //             'fill' => [
    //                 'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
    //                 'startColor' => ['rgb' => 'F2F2F2'],
    //             ]
    //         ]);
        
    //         $highestRow = $sheet->getHighestRow();
        
    //         // Apply borders dynamically for all rows containing employee data
    //         $sheet->getStyle("A7:I{$highestRow}")->applyFromArray([
    //             'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
    //         ]);
        
    //         // **Dynamic Styling Per Employee**
    //         $startRow = 8; // Assuming employee data starts from row 8
    //         for ($row = $startRow; $row <= $highestRow; $row++) {
    //             if ($this->isEmployeeRow($sheet, $row)) {
    //                 $sheet->getStyle("A{$row}:I{$row}")->applyFromArray([
    //                     'font' => ['bold' => true, 'size' => 12],
    //                     'alignment' => ['horizontal' => 'center'],
    //                     'fill' => [
    //                         'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
    //                         'startColor' => ['rgb' => 'D9EAD3'], // Light Green for employee headers
    //                     ]
    //                 ]);
    //             }
    //         }
    //     }