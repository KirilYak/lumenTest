<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('companies')->truncate();

        $usersCount = 10;

        $faker = Factory::create();
        $users = [];
        for ($x = 1; $x <= $usersCount; $x++) {
            $users[] = [
                'email' => $faker->email,
                'password' => $faker->password,
                'api_token' => Str::random(32),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'phone' => $faker->phoneNumber,

            ];
        }

        $companies = [];
        for ($x = 1; $x <= 50; $x++) {
            $companies[] = [
                'userId' => rand(1, $usersCount),
                'title' => $faker->title . '_' . Str::random('5'),
                'phone' => $faker->phoneNumber,
                'description' => $faker->text,
            ];
        }


        DB::table('users')->insert($users);
        DB::table('companies')->insert($companies);
    }
}
