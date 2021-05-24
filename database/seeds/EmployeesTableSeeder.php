<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeesTableSeeder extends Seeder
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
            # code...
            DB::table('employees')->insert([
                'name' => $faker->firstName,
                'ic' => $faker->unique()->lexify(str_repeat('?', 12)),
                'pword' => 'admin123',
                'role' => 1,
                'position' => $faker->jobTitle,
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->email,
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'zipcode' => $faker->postcode,
                'state' => $faker->state,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
