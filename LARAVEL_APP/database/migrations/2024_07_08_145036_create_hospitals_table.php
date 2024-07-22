<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('address');
            $table->string('location');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->text('description')->nullable();
            $table->string('picture')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('hospitals');
    }
};