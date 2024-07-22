<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('detections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->references('id')->on('doctors');
            $table->string('input_image');
            $table->string('output_image');
            $table->string('detection_result');
            $table->string('classification_result');
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('detections');
    }
};