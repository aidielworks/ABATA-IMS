<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = ['receipt_no', 'receipt_date', 'receipt_name', 'receipt_receiver_ic', 'receipt_address', 'receipt_total', 'receipt_issuedby'];
}
