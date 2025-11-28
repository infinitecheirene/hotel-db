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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_name');
            $table->enum('type', ['single', 'double', 'suite']);
            $table->decimal('price');
            $table->text('description')->nullable();
            $table->json('amenities')->nullable();
            $table->json('bed_type')->nullable();
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->boolean('available')->default(true);
            $table->integer('max_guests')->default(1);
            $table->integer('size')->nullable(); // in square feet
            $table->string('location')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
