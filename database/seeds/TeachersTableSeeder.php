<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('ms_MY');

        for ($i = 0; $i < 50; $i++) {
            DB::table('teachers')->insert([
                'name' => $faker->firstName,
                'ic' => $faker->unique()->lexify(str_repeat('?', 12)),
                'pword' => 'teacher123',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->email,
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'zipcode' => $faker->postcode,
                'state' => $faker->state,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
