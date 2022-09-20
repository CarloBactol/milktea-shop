<?php

namespace Database\Seeders;

use App\Models\AddOn;
use Illuminate\Database\Seeder;

class AddOnsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AddOn::create(
            [
                'name' => 'Bamboo Charcoal',
                'price' => '10'
            ],
        );

        AddOn::create(
            [
                'name' => ' Okinawa',
                'price' => '15'
            ],
        );

        AddOn::create(
            [
                'name' => 'Hokkaido',
                'price' => '20'
            ],
        );
    }
}
