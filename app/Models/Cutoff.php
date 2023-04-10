<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cutoff extends Model
{
    use HasFactory;

    protected $primaryKey = 'cutoff_id';
    protected $fillable = [
        'cutoff_date',
    ];

    public function Attendances()
    {
        return $this->hasMany(Attendances::class, 'cutoff_id', 'cutoff_id');
    }
}
