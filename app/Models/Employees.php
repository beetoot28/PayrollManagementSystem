<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeDetails;
use App\Models\Loans;
use App\Models\Attendances;

class Employees extends Model
{
    use HasFactory;

    protected $primaryKey = 'employee_id';
    protected $fillable = [
        'employee_code',
        'first_name',
        'middle_name',
        'last_name',
        'age',
        'date_of_birth',
        'sex',
        'mobile_no',
        'nationality',
        'employee_status',
        'employee_photo',

    ];

    public function EmployeeDetails()
    {
        return $this->hasOne(EmployeeDetails::class, 'employee_id', 'employee_id');
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
}
