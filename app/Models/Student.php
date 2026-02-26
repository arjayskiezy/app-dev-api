<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'students';

    protected $fillable = [
        'user_id',
        'fname',
        'mname',
        'lname',
        'gender',
        'student_number',
        'birthday',
    ];

}
