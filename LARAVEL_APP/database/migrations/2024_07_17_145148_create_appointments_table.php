<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->references('id')->on('doctors')->cascadeOnDelete();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('clinic_id')->references('id')->on('clinics')->cascadeOnDelete();
            $table->string('patient_name');
            $table->string('patient_gender')->nullable();
            $table->string('patient_age')->nullable();
            $table->string('patient_phone')->nullable();
            $table->float('appointment_price');
            $table->string('appointment_type');
            $table->integer('appointment_number');
            $table->date('appointment_date');
            $table->string('appointment_day');
            $table->time('appointment_time');
            $table->string('status')->default('pending');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};