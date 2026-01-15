<?php

use App\Http\Models\Setting;
use Faker\Factory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string("school_title");
            $table->integer("default_program_duration");
            $table->timestamps();
        });


        if(Setting::count() < 1)
        {
            $setting = new Setting();
        } else {
            $setting = Setting::first();
        }

        $faker = Factory::create();

        $setting->school_title = $faker->company;
        $setting->default_program_duration = 2;

        $setting->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
