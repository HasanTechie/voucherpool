<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use \Faker\Factory;
use Illuminate\Support\Str;
use App\Models\Recipient;
use App\Models\Offer;
use App\Models\Code;

class GenerateFakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $recipients = [];
        $offers = [];
        $codes = [];

        for ($i = 1; $i < 100; $i++) {
            $recipients[] = [
                'id' => $i,
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        }

        for ($i = 1; $i < 10; $i++) {
            $offers [$i] = [
                'id' => $i,
                'name' => $faker->sentence(2),
                'discount' => $faker->numberBetween(1, 19) * 5,
                'expiry' => $faker->dateTimeBetween('-1 months', '+9 months'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];

            foreach ($recipients as $recipient) {
                $codes [] = [
                    'offer_id' => $offers[$i]['id'],
                    'recipient_id' => $recipient['id'],
                    'code' => Str::random(8),
                    'used_on' => (mt_rand(0, 2) <= 1) ? $faker->dateTimeBetween('-1 months', 'now') : NULL,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ];
            }
        }

        Recipient::insert($recipients);
        Offer::insert($offers);
        Code::insert($codes);

    }
}
