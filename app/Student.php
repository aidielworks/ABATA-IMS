<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id', 'name', 'ic', 'pword', 'phonenumber', 'email', 'houseNo', 'streetName', 'city', 'zipcode', 'state', 'image', 'bank_name', 'bank_acc_no', 'latitude', 'longitude', 'teacher'
    ];

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('name', 'like', '%' . $search . '%')
            ->orWhere('ic', 'like', '%' . $search . '%');
    }

    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher', 'ic');
    }
}
