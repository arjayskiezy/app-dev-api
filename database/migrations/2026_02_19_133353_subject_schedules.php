<?php

use App\Enums\Semester;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subject_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->string('section', 10);
            $table->time('time_start');
            $table->time('time_end');
            $table->string('room', 10)->nullable();
            $table->string('school_year');
            $table->enum('semester', array_column(Semester::cases(), 'value'));
            $table->timestamps();

            $table->unique(['subject_id','section','school_year','semester']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_schedules');

    }
};
