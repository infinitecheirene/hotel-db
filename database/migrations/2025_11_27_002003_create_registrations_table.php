<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('registration')) {
            Schema::create('registration', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('email')->unique();
                $table->string('password');
                $table->timestamp('email_verified_at')->nullable();
                $table->rememberToken();
                $table->timestamps();
                $table->index('email');
                $table->index('name');
            });
        } else {
            Schema::table('registration', function (Blueprint $table) {
                if (!Schema::hasColumn('registration', 'name')) {
                    $table->string('name')->unique()->after('id');
                    $table->index('name');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('registration');
    }
};