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
        Schema::create('tags_category', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default("")->nullable();
            $table->string('ownerName')->default("")->nullable();
            $table->string('fatherName')->default("")->nullable();
            $table->string('brand')->default("")->nullable();
            $table->string('luggageType')->default("")->nullable();
            $table->string('gender')->default("")->nullable();
            $table->string('age')->default("")->nullable();
            $table->string('weight')->default("")->nullable();
            $table->string('height')->default("")->nullable();
            $table->string('dressColor')->default("")->nullable();
            $table->string('address')->default("")->nullable();
            $table->string('color')->default("")->nullable();
            $table->string('mobileNumber')->default("")->nullable();
            $table->string('mobileNumber2')->default("")->nullable();
            $table->string('contactEmail')->default("")->nullable();
            $table->string('reward')->default("")->nullable();
            $table->string('vetDetail')->default("")->nullable();
            $table->string('doctorDetail')->default("")->nullable();
            $table->string('medicalIssue')->default("")->nullable();
            $table->string('note')->default("")->nullable();
            $table->string('category')->default("")->nullable();
            $table->string('userId')->default("");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags_category');
    }
};
