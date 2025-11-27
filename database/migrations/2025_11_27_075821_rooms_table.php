<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GenerateRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['single', 'double', 'suite']);
            $table->decimal('price', 10, 2);
            $table->text('description');
            $table->json('amenities');
            $table->string('image');
            $table->json('images')->nullable();
            $table->boolean('available')->default(true);
            $table->integer('max_guests');
            $table->integer('size'); // in square meters
            $table->string('location')->default('Makati City');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
