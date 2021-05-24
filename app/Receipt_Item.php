<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt_Item extends Model
{
    protected $table = 'receipt_items';
    protected $fillable = ['receipt_no', 'item_name', 'item_quantity', 'item_price', 'item_actual_amount'];
}
