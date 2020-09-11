<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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

        for($i = 0; $i<99; $i++){
            echo $i . "\n";
        }

    }
}
