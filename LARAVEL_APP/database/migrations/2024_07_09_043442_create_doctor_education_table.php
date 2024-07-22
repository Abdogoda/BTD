<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('doctor_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->references('id')->on('doctors')->cascadeOnDelete();
            $table->year('start');
            $table->year('end')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('type')->default('education');
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('doctor_education');
    }
};