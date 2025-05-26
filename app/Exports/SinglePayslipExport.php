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





class SinglePayslipExport implements FromView, WithStyles, ShouldAutoSize, WithColumnWidths
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

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function view(): View
    {
        $employee_data = $this->data;
        return view('exports.employeepayslip', compact('employee_data'));
    }

  
    public function styles(Worksheet $sheet)
    {
        // $sheet->mergeCells("A1:G1");
        // $sheet->mergeCells("A2:C2");
        // $sheet->mergeCells("D2:G2");
        // $sheet->mergeCells("A3:C3");
        // $sheet->mergeCells("D3:G3");
        // $sheet->mergeCells("A4:C4");
        // $sheet->mergeCells("D4:G4");
        // $sheet->mergeCells("A5:G5");

        // $sheet->getStyle('A1:A5')->applyFromArray([
        //     'font' => ['bold' => true, 'size' => 14],
        //     'alignment' => ['horizontal' => 'center'],
        // ]);

        // $sheet->getStyle('A7:I7')->applyFromArray([
        //     'font' => ['bold' => true, 'size' => 12],
        //     'alignment' => ['horizontal' => 'center'],
        //     'fill' => [
        //         'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        //         'startColor' => ['rgb' => 'F2F2F2'],
        //     ]
        // ]);

        // $highestRow = $sheet->getHighestRow();
        // $sheet->getStyle("A7:I{$highestRow}")->applyFromArray([
        //     'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        // ]);
    }
    
    public function columnWidths(): array
    {
        return [
          
        ];
    }

}
