<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherCompanyDr extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'amount',
        'note',
        'cutoff_id',
        'is_paid',
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
