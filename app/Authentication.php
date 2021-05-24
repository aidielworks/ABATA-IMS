<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    protected $fillable = ['ic', 'name', 'type', 'login', 'logout'];
}
