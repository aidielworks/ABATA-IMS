<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spform extends Model
{
    protected $fillable = ['teacherIC', 'studentIC', 'class_date', 'learning_topic', 'review', 'status'];

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->Where('studentIC', 'like', '%' . $search . '%');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentIC', 'ic');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacherIC', 'ic');
    }
}
