<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProgramIdToDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->unsignedInteger("program_id")->after("title");
        });

        Schema::table("departments", function (Blueprint $table)
        {
            $table->foreign("program_id")->references("id")->on("programs")->onDelete("cascade");
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedInteger("department_id")->after("title");
        });

        Schema::table("courses", function (Blueprint $table)
        {
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
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign("program_id");
            $table->dropColumn("program_id");
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign("department_id");
            $table->dropColumn("department_id");
        });
    }
}
