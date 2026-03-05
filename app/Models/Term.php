<?php

namespace App\Models;

use App\Enums\Semester;
use App\Enums\TermStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Term extends Model
{
    protected $fillable = [
        "name",
        "school_year_id",
        "semester",
        "start_date",
        "end_date",
        "status",
    ];

    protected $casts = [
        "semester" => Semester::class,
        "start_date" => "date",
        "end_date" => "date",
        "status" => TermStatus::class,
    ];

    /**
     * Get the school year associated with the term.
     * @return BelongsTo<SchoolYear>
     */
    public function schoolYear(): BelongsTo
    {
        return $this->belongsTo(SchoolYear::class);
    }

    /**
     * Get the enrollments associated with the term.
     * @return HasMany<Enrollment>
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get the section associated with the term.
     * @return HasMany<Section>
     */
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }
}
