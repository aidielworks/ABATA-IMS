<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deductions extends Model
{
    use HasFactory;
    protected $fillable = [
        'payroll_reference_no',
        'deduction_item',
        'deduction_amount'
    ];
}
