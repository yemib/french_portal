<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string("surname");
            $table->string("first_name");
            $table->string("other_names");
            $table->string("email")->unique();
            $table->string("password");
            $table->string("sex");
            $table->string("marital_status");
            $table->string("phone");
            $table->date("dob");
            $table->string("nationality");
            $table->string("state_of_origin");
            $table->string("place_of_birth");
            $table->string("postal_address");
            $table->string("permanent_address")->nullable();
            $table->string("next_of_kin");
            $table->string("next_of_kin_relationship");
            $table->string("next_of_kin_occupation");
            $table->string("next_of_kin_address");
            $table->string("nysc_status");
            $table->string("had_disability");
            $table->string("had_disability_yes")->nullable();
            $table->string("level_of_french_proficiency");
            $table->string("any_post_secondary_qualification");
            $table->string("any_post_secondary_qualification_yes")->nullable();
            $table->string("any_post_secondary_qualification_year")->nullable();
            $table->string("any_post_secondary_qualification_institution")->nullable();
            $table->string("course_in_view");
            $table->string("course_in_view_award")->nullable();
            $table->string("applied_before");
            $table->string("applied_before_yes")->nullable();
            $table->string("attended_course_before");
            $table->string("attended_course_before_yes")->nullable();
            $table->boolean("processed")->default(0);
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
        Schema::dropIfExists('application_forms');
    }
}
