<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $faker = \Faker\Factory::create();

            if(!$new_user = \App\User::where("account_type", "super_admin")->first())
            {
                $new_user = new \App\User();
                $new_user->email = $faker->email;
            }

            $password = "123456";
            $new_user->gender = "male";

            $new_user->full_name = $faker->name($new_user->gender);
            $new_user->password = bcrypt($password);
            $new_user->account_type = "super_admin";
            $new_user->save();

            Log::info("New super admin has been seeded successfully with the following info: ".$new_user->email.", ".$password);
        } catch (Exception $exception)
        {
            Log::error("The following error occurred while trying to seed super admin user ". $exception->getMessage());
        }
    }
}
