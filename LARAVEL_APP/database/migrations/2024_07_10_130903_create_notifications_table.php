<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('notification_for');
            $table->foreignId('doctor_id')->nullable()->references('id')->on('doctors')->cascadeOnDelete();
            $table->text('message');
            $table->tinyInteger('read')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('notifications');
    }
};