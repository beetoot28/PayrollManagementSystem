<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $primaryKey = 'payroll_id';
    protected $fillable = [
        'cutoff_id',
        'employee_code',
        'employee_id',
        'no_of_workingdays',
        'holiday_pay',
        'overtime_pay',
        'holiday_overtime_pay',
        'absences',
        'absences_amount',
        'late_undertime',
        'late_undertime_pay',
        'total_allowance',
        'leave_pay',
        'gross_pay',
        'employees_dr',
        'dr_to_other_company',
        'due_from',
        'total_deductions',
        'net_salary',
        'sss_contribution_id',
        'philhealth_contribution_id',
        'hdmf_contribution_id',
        'ef_contribution_id',
        'remarks',
        'payroll_cycle',
        'status',
    ];

    public function Cutoff()
    {
        return $this->belongsTo(Cutoff::class, 'cutoff_id', 'cutoff_id');
    }

    public function Employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id', 'employee_id');
    }

    public function EmployeeDetails()
    {
        return $this->belongsTo(EmployeeDetails::class, 'employee_id', 'employee_id');
    }

    public function Loans()
    {
        return $this->hasMany(Loans::class, 'employee_id', 'employee_id');
    }

    public function Attendances()
    {
        return $this->hasMany(Attendances::class, 'employee_no', 'employee_code');
    }

    public function EmployeeDr()
    {
        return $this->hasMany(EmployeeDr::class, 'employee_id', 'employee_id');
    }

    public function DueFrom()
    {
        return $this->hasMany(DueFrom::class, 'employee_id', 'employee_id');
    }

    public function OtherCompanyDr()
    {
        return $this->hasMany(OtherCompanyDr::class, 'employee_id', 'employee_id');
    }
}
