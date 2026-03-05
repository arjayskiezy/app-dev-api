<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Enrollment extends Model
{
    protected $fillable = ["student_id", "program_id", "term_id"];

    /**
     * Get the students associated with the enrollment.
     * @return HasMany<Student>
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Get the program associated with the enrollment.
     * @return BelongsTo<Program>
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Get the term associated with the enrollment.
     * @return HasOne<Term>
     */
    public function term(): HasOne
    {
        return $this->hasOne(Term::class);
    }
}
