<?php

namespace App\Imports;

use App\Models\Attendances;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

// class ImportAttendances implements ToModel, WithHeadingRow
// {
//     /**
//     * @param array $row
//     *
//     * @return \Illuminate\Database\Eloquent\Model|null
//     */
//     public function model(array $row)
//     {
//         return new Attendances([
//             'employee_no' => $row[0],
//             'account_no' => $row[1],
//             'number' => $row[2],
//             'date_in' => $row[3],
//             'time_in_am' => $row[4],
//             'time_out_am' => $row[5],
//             'time_in_pm' => $row[6],
//             'time_out_pm' => $row[7],
//         ]);
//     }
// }

class ImportAttendances implements ToCollection
{
    public $data;
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $this->data = $row;
        }
        return $data;
    }
}
