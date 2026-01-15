<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHostelSpaceStyle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("hostels", function (Blueprint $table)
        {
            $table->dropColumn("capacity");
            $table->integer("rooms");
            $table->integer("room_capacity");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("hostels", function (Blueprint $table)
        {
            $table->dropColumn("rooms");
            $table->dropColumn("room_capacity");
        });
    }
}
