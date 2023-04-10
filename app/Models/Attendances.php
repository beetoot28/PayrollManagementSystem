<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    use HasFactory;

    protected $primaryKey = 'attendance_id';
    protected $fillable = [
        'employee_no',
        'cutoff_id',
        'account_no',
        'number',
        'date_in',
        'time_in_am',
        'time_out_am',
        'time_in_pm',
        'time_out_pm',

    ];

    public function Employee()
    {
        return $this->belongsTo(Employees::class, 'employee_code', 'employee_no');
    }

    public function Cutoff()
    {
        return $this->belongsTo(Cutoff::class, 'cutoff_id', 'cutoff_id');
    }
}
