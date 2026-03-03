<?php

namespace App\Models;

use App\Enums\Semester;
use App\Enums\TermStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Term extends Model
{
    protected $fillable = 
    [
        "name",
        "school_year_id",
        "semester",
        "start_date",
        "end_date",
        "status",
    ];

    protected $casts = [
        "semester"=> Semester::class,
        "start_date"=> "date",
        "end_date"=>"date",
        "status"=> TermStatus::class,
    ];
    public function term() : BelongsTo
    {
        return $this->belongsTo(Term::class);
    }
}
