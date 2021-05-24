<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allowances extends Model
{
    use HasFactory;
    protected $fillable = [
        'payroll_reference_no',
        'allowance_item',
        'allowance_amount'
    ];
}
