<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemitaPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remita_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("student_id")->nullable();
            $table->string("rrr");
            $table->double("amount")->default(0);
            $table->boolean("paid")->default(0);
            $table->integer("session")->nullable();
            $table->string("reason")->default("tuition");
            $table->foreign("student_id")->references("id")->on("students")->onDelete("cascade");
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
        Schema::dropIfExists('remita_payments');
    }
}
