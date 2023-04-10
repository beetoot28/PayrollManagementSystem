<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolidayComputations extends Model
{
    use HasFactory;

    protected $primaryKey = 'computation_id';
    protected $fillable = [
        'computation_field1',
        'computation_field2',
        'computation_field3',
        'computation_field4',
        'computation_field5',
        'computation_field6',
        'computation_field7',
    ];
}
