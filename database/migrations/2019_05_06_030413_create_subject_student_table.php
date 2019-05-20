<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_student', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_id');
            $table->string('subject_id');
            $table->string('quiz_1')->nullable();
            $table->string('quiz_2')->nullable();
            $table->string('quiz_3')->nullable();
            $table->string('assignment_1')->nullable();
            $table->string('assignment_2')->nullable();
            $table->string('assignment_3')->nullable();
            $table->string('midterm')->nullable();
            $table->string('final')->nullable();
            $table->string('possible_highest_mark')->nullable();
            $table->string('final_mark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_student');
    }
}
