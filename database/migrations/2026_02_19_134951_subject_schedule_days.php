<?php

use App\Enums\Day;
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
        Schema::create('subject_schedule_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_schedule_id')->constrained()->cascadeOnDelete();
            $table->enum('day', array_column(Day::cases(), 'value'));
            $table->timestamps();

            $table->unique(['subject_schedule_id','day']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_schedule_days');

    }
};
