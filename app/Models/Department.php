<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = ["name", "code", "title"];

    /**
     * Get the programs associated with the department.
     * @return HasMany<Program>
     */
    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }

    /**
     * @return HasMany<Room>
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    /**
     * @return HasMany<Teacher>
     */
    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }
}
