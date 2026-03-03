<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{

    protected $fillable = [
        'user_id',
        'fname',
        'mname',
        'lname',
        'gender',
        'student_number',
        'birthday',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
