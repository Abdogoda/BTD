<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('specialization_id')->references('id')->on('specializations')->cascadeOnDelete();
            $table->foreignId('hospital_id')->nullable()->references('id')->on('hospitals')->cascadeOnDelete();
            $table->integer('years_of_experience')->nullable();
            $table->text('about')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('doctors');
    }
};