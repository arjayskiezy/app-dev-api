<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $fillable = [
        'user_id',
        'department_id',
        'fname',
        'mname',
        'lname',
        'gender',
        'employee_number',
        'birthday',
    ];
}
