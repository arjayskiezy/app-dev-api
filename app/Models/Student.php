<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * @return HasMany<SubjectEnrollment>
     */
    public function subjectEnrollments(): HasMany
    {
        return $this->hasMany(SubjectEnrollment::class);
    }

    /**
     * @return HasOne<Enrollment>
     */
    public function enrollment(): HasOne
    {
        return $this->hasOne(Enrollment::class);
    }
}
