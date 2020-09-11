<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \Faker\Factory;

class GenerateFakeData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();

        $recipients = [];

        for ($i = 0; $i < 99; $i++) {
            $recipients[] = DB::table('recipients')
                ->insertGetId([
                    'name'          => $faker->name,
                    'email'         => $faker->unique()->email,
                    'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
        }
    }
}
