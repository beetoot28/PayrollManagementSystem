<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'payroll_details_id';
    protected $fillable = [
        'cutoff_id',
        'employee_id',
        'attendance_id',
        'working_hours',
        'working_hours_overtime',
        'holiday_type',
        'is_restday',
        'is_work',
        'pay',
    ];
}
