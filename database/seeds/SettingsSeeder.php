<?php

use App\Http\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Setting::count() < 1)
        {
            $setting = new Setting();
        } else {
            $setting = Setting::first();
        }

        $faker = \Faker\Factory::create();

        $setting->school_title = $faker->company;
        $setting->default_program_duration = 2;

        $setting->save();
    }
}
