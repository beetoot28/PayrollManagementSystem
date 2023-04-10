<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContributionHDMF extends Model
{
    use HasFactory;

    protected $table = 'hdmf_contributions';
    protected $fillable = [
        'cutoff_id',
        'employee_id',
        'contribution_amount',
    ];
}
