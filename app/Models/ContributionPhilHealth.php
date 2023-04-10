<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContributionPhilHealth extends Model
{
    use HasFactory;

    protected $table = 'philhealth_contributions';
    protected $fillable = [
        'cutoff_id',
        'employee_id',
        'contribution_amount',
    ];
}
