<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeavePay extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        // 'number_of_days',
        // 'start_date',
        // 'end_date',
        'leave_date',
        'note',
        'is_used',
    ];

    public function Employee()
    {
        return $this->hasOne(Employees::class, 'employee_id', 'employee_id');
    }

    public function EmployeeDetails()
    {
        return $this->hasOne(EmployeeDetails::class, 'employee_id', 'employee_id');
    }
}
