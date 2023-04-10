<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Employees;

class EmployeeDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'employee_details_id';
    protected $fillable = [
        'employee_id',
        'block_house_no',
        'street',
        'barangay',
        'city',
        'province',
        'marital_status',
        'no_of_children',
        'spouse_name',
        'spouse_occupation',
        'dependant',
        'emergency_contact_name',
        'emergency_contact_no',
        'emergency_contact_address',
        'basic_rate',
        'allowance',
        'leave_with_pay',
        'with_ot_pay',
        'department',
        'position',
        'employee_history_position',
        'sss_no',
        'philhealth_no',
        'tin_no',
        'hdmf_no',
        'date_hired',
        'date_resigned',
        'employment_status',
        'sss_contribution',
        'philhealth_contribution',
        'ef_contribution',
        'hdmf_contribution',

    ];

    public function Employees()
    {
        return $this->belongsTo(Employees::class, 'employee_id', 'employee_id');
    }
}
