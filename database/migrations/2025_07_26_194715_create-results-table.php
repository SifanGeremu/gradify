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
        //results table 
        Schema::create('results', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('student_id');
        $table->unsignedBigInteger('course_id');

        $table->integer('score'); 
        $table->string('letter_grade'); 

        $table->timestamps();

        // Foreign key 
        $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
