<?php

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
        Schema::create('doctor_schedules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
        $table->date('available_from');
        $table->date('available_to');
        $table->time('start_time');
        $table->time('end_time');
        $table->integer('slot_duration'); // in minutes
        $table->integer('total_slots');
        $table->boolean('is_available')->default(true);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_schedules');
    }
};
