<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Auth;

class ExportPayrolls implements FromCollection, WithHeadings, WithTitle, WithCustomStartCell, WithStyles, ShouldAutoSize
{
    protected $export_this;

    public function __construct($export_this)
    {
        return $this->export_this = $export_this;
    }

    public function startCell(): string
    {
        return 'A4';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:G1');
        $sheet->mergeCells('A2:B2');
        $sheet->setCellValue('A1', "PAYROLL LISTS" );
        $sheet->setCellValue('A2', "Date Exported: ".date('F d, Y'));

        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'size' => 15]],
            4    => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function title(): string
    {
    	return 'Loans Lists';
    }

    public function headings():array{
        return[
            'Employee Code',  'First Name', 'Middle Name', 'Last Name', 'Employee Status', 'Department', 'Number of Workingdays', 'Holiday Pay', 'Overtime_pay', 'Holiday Overtime Pay', 'Absences', 'Absences Amount', 'Late Undertime', 'Late Undertime Pay', 'Employees Dr', 'Dr To Other Company', 'Due From', 'SSS Contribution_id', 'Philhealth Contribution_id', 'HDMF Contribution_id', 'EF Contribution_id', 'Leave Pay', 'Gross Pay', 'Total Deductions', 'Net Salary', 'Payroll Cycle', 'Remarks', 'Cutoff Date', 'Working Hours', 'Working Hours Overtime', 'Holiday Type', 'Restday', 'Worked', 'Pay'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->export_this);
    }
}
