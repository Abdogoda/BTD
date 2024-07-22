<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->references('id')->on('appointments')->cascadeOnDelete();
            $table->string('diagnosis');
            $table->longText('report');
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('reports');
    }
};