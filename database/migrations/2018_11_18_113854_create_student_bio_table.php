<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentBioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_bio', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("student_id");
            $table->string("phone");
            $table->date("dob");
            $table->string("school_of_origin")->nullable();
            $table->integer("state_of_origin");
            $table->string("next_of_kin_name");
            $table->string("next_of_kin_phone");
            $table->string("next_of_kin_address");
            $table->timestamps();
        });

        Schema::table("student_bio", function (Blueprint $table)
        {
            $table->foreign("student_id")->references("id")->on("students")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_bio');
    }
}
