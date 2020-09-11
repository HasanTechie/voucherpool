<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use \Faker\Factory;
use Illuminate\Support\Str;

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
                    'name' => $faker->name,
                    'email' => $faker->unique()->email,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
        }

        for ($i = 0; $i < 9; $i++) {
            $offer = DB::table('offers')
                ->insertGetId([
                    'name' => $faker->sentence(5),
                    'discount' => $faker->numberBetween(1, 19) * 5,
                    'expiry' => $faker->dateTimeBetween('-1 months', '+9 months'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

            foreach ($recipients as $recipient) {
                DB::table('codes')
                    ->insert([
                        'offer_id' => $offer,
                        'recipient_id' => $recipient,
                        'code' => Str::random(8),
                        'used_on' => (mt_rand(0, 2) <= 1) ? $faker->dateTimeBetween('-1 months', 'now') : NULL,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);
            }
        }
    }
}
