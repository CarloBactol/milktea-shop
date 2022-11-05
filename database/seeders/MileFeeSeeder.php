<?php

namespace Database\Seeders;

use App\Models\MileFee;
use Illuminate\Database\Seeder;

class MileFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MileFee::create(
            [

                'miles' => '1',
                'price' => '50'
            ],
        );
        MileFee::create(
            [

                'miles' => '2',
                'price' => '60'
            ],
        );
    }
}
