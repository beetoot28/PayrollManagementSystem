<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    use HasFactory;

    protected $primaryKey = 'loan_id';
    protected $fillable = [
        'employee_id',
        'type_of_loan',
        'loan_application_no',
        'loan_date',
        'loan_terms',
        'deduction_from',
        'deduction_to',
        'loan_amount',
        'monthly_due',
        'is_paid',

    ];

    public function Employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id', 'employee_id');
    }

    public function EmployeeDetail()
    {
        return $this->belongsTo(EmployeeDetails::class, 'employee_id', 'employee_id');
    }
}
