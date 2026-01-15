<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("user_id");
            $table->string("staff_id");
            $table->unsignedInteger("department_id");
            $table->timestamps();
        });

        Schema::table("lecturers", function (Blueprint $table)
        {
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("department_id")->references("id")->on("departments")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("lecturers", function (Blueprint $table)
        {
            $table->dropForeign("user_id");
            $table->dropForeign("department_id");
        });

        Schema::dropIfExists('lecturers');
    }
}
