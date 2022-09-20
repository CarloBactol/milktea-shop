<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class BotleSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Size::create(
            [
                'size' => '0',
                'price' => '90'
            ],
        );
        Size::create(
            [
                'size' => '1',
                'price' => '120'
            ],
        );
    }
}
