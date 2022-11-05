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
                'name' => 'Classic',
            ],
        );

        AddOn::create(
            [
                'name' => ' Wintermelon',
            ],
        );

        AddOn::create(
            [
                'name' => 'Okinawa',
            ],
        );

        AddOn::create(
            [
                'name' => 'Taro',
            ],
        );

        AddOn::create(
            [
                'name' => 'Red velvet ',
            ],
        );
        AddOn::create(
            [
                'name' => 'Cookies and cream ',
            ],
        );
        AddOn::create(
            [
                'name' => 'Bubble gum ',
            ],
        );
    }
}
