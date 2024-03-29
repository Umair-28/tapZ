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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->string('email')->unique()->default("");
            $table->string('password')->default("")->nullable();
            $table->string('loginWith')->default("")->nullable();
            $table->string('platform')->default("")->nullable();
            $table->string('fcmToken')->default("")->nullable();
            $table->string('googleId')->default("")->nullable();
            $table->string('facebookId')->default("")->nullable();
            $table->string('appleId')->default("")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
