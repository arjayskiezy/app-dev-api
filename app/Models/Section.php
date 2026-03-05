<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $fillable = [
        "subject_id",
        "teacher_id",
        "room_id",
        "term_id",
        "section_code",
        "time_start",
        "time_end",
        "max_slots",
        "status",
    ];

    /**
     * @return BelongsTo<Subject>
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * @return HasOne<Term>
     */
    public function term(): HasOne
    {
        return $this->hasOne(Term::class);
    }

    /**
     * @return HasOne<Teacher>
     */
    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class);
    }

    /**
     * @return HasMany<SubjectEnrollment>
     */
    public function subjectEnrollment(): HasMany
    {
        return $this->hasMany(SubjectEnrollment::class);
    }

    /**
     * @return HasMany<SectionDay>
     */
    public function sectionDays(): HasOne
    {
        return $this->hasMany(SectionDay::class);
    }

    /**
     * @return HasOne<Room>
     */
    public function room(): HasOne
    {
        return $this->hasOne(Room::class);
    }
}
