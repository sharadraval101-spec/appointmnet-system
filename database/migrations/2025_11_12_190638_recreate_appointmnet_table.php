<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->string('patient_name');
            $table->string('email');
            $table->string('phone');
            $table->string('gender')->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->text('concern')->nullable();
            $table->json('documents')->nullable();
            $table->enum('status', ['pending', 'approved', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->index(['doctor_id', 'appointment_date', 'appointment_time']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
