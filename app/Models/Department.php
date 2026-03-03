<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Department extends Model
{
    protected $fillable = [
        "name",
        "code",
        "title",
    ];

    public function program () : HasOne
    {
        return $this->hasOne(Program::class);
    }
}
