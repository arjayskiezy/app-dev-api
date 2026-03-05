<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        "user_id",
        "fname",
        "mname",
        "lname",
        "gender",
        "student_number",
        "birthday",
    ];

    /**
     * Get the user associated with the student.
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
