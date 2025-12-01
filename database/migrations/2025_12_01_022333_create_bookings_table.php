<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('room_name');
            $table->timestamp('check_in');
            $table->timestamp('check_out');
            $table->integer('guest_no');
            $table->integer('night_no');
            $table->text('special_requests')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['Confirmed', 'Pending', 'Canceled', 'Reserved'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
