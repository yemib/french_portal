<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostelAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostel_allocations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("hostel_id");
            $table->unsignedInteger("student_id");
            $table->unsignedInteger("session_id");
            $table->integer("space_id");
            $table->timestamps();
        });

        Schema::table("hostel_allocations", function (Blueprint $table)
        {
            $table->foreign("hostel_id")->references("id")->on("hostels")->onDelete("cascade");
            $table->foreign("student_id")->references("id")->on("students")->onDelete("cascade");
            $table->foreign("session_id")->references("id")->on("sessions")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("hostel_allocations", function (Blueprint $table)
        {
            $table->dropForeign("hostel_id");
            $table->dropForeign("student_id");
            $table->dropForeign("session_id");
        });

        Schema::dropIfExists('hostel_allocations');
    }
}
