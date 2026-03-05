<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    protected $fillable = [
        "user_id",
        "department_id",
        "fname",
        "mname",
        "lname",
        "gender",
        "employee_number",
        "birthday",
    ];

    /**
     * Get the user associated with the teacher.
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<Section>
     */
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    /**
     * @return BelongsTo<Program>
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
