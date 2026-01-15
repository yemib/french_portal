<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("student_id");
            $table->integer("session");
            $table->unsignedInteger("voucher_id");
            $table->double("amount")->default(0);
            $table->string("reason")->default("tuition");
            $table->boolean("verified")->default(0);
            $table->timestamps();
        });

        Schema::table("payments", function (Blueprint $table)
        {
            $table->foreign("student_id")->references("id")->on("students")->onDelete("cascade");
            $table->foreign("voucher_id")->references("id")->on("vouchers")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
