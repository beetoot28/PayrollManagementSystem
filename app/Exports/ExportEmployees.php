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

class ExportEmployees implements FromCollection, WithHeadings, WithTitle, WithCustomStartCell, WithStyles, ShouldAutoSize
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
        $sheet->setCellValue('A1', "EMPLOYEES LISTS" );
        $sheet->setCellValue('A2', "Date Exported: ".date('F d, Y'));

        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'size' => 15]],
            4    => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function title(): string
    {
    	return 'Employee Lists';
    }

    public function headings():array{
        return[
            'Employee Code',
            'First Name',
            'Middle Name',
            'Last Name', 'Sex', 'Mobile No', 'Nationality', 'Employee Status', 'Block House No', 'Street', 'Barangay', 'City', 'Province',
            'Marital Status', 'Spouse Name', 'Spouse Occupation', 'Dependant', 'Emergency Contact Name', 'Emergency Contact No', 'Emergency Contact Address',
            'Basic Rate', 'Allowance', 'Leave with Pay', 'With OT Pay', 'Department', 'Position', 'Employee History Position', 'SSS Number', 'Philhealth Number',
            'TIN Number', 'HDMF Number', 'Date Hired', 'Date Resigned', 'Employment Status', 'SSS Contribution', 'Philhealth Contribution', 'EF Contribution', 'HDMF Contribution'
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
