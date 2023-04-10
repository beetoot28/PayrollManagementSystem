<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPayments extends Model
{
    use HasFactory;

    protected $primaryKey = 'loan_payment_id';
    protected $fillable = [
        'loan_id',
        'cutoff_id',
        'amount',
    ];

    public function Loans()
    {
        return $this->belongsTo(Loans::class, 'loan_id', 'loan_id');
    }
}
