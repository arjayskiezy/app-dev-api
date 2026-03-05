<?php

namespace App\Models;

use App\Enums\SchoolYearStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolYear extends Model
{
    protected $fillable = ["name", "start_date", "end_date", "status"];

    protected $casts = [
        "start_date" => "date",
        "end_date" => "date",
        "status" => SchoolYearStatus::class,
    ];

    /**
     * Get the terms associated with the school year.
     * @return HasMany<Term>
     */
    public function terms(): HasMany
    {
        return $this->hasMany(Term::class);
    }
}
