<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'ic', 'pword', 'role', 'position', 'phonenumber', 'email', 'address', 'city', 'zipcode', 'state', 'image', 'bank_name', 'bank_acc_no'];

    public function job()
    {
        return $this->belongsTo(JobType::class, 'position', 'id');
    }


    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('name', 'like', '%' . $search . '%')
            ->orWhere('ic', 'like', '%' . $search . '%');
    }
}
