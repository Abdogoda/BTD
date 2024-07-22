<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->foreignId('doctor_id')->references('id')->on('doctors')->cascadeOnDelete();
            $table->string('address');
            $table->string('location');
            $table->float('visiting_price');
            $table->float('follow_up_price')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('clinics');
    }
};