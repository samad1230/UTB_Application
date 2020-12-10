<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class DepartmentUser extends Model
{
    protected $fillable = [
        'department_id','user_id'
    ];
}
