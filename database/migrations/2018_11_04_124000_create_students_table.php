<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger("program_id");
            $table->unsignedInteger("department_id");
            $table->string("registration_number");
            $table->smallInteger("current_session")->default(1);
            $table->timestamps();
        });

        Schema::table('students', function (Blueprint $table)
        {
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("program_id")->references("id")->on("programs")->onDelete("cascade");
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
        Schema::table("students", function (Blueprint $table)
        {
            $table->dropForeign("user_id");
            $table->dropForeign("department_id");
            $table->dropForeign("program_id");
        });

        Schema::dropIfExists('students');
    }
}
