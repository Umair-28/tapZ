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
        Schema::create('connections', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('')->nullable();
            $table->string('email')->default('')->nullable();
            $table->string('phone_number')->default('')->nullable();
            $table->longText('message')->default('')->nullable();
            $table->string('tagId')->default('')->nullable();
            $table->string('userId')->default('')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connections');
    }
};
