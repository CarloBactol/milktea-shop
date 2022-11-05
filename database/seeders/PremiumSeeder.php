<?php

namespace Database\Seeders;

use App\Models\Premium;
use Illuminate\Database\Seeder;

class PremiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Premium::create(
            [
                'size' => '0',
                'price' => '48',
                'category_id' => '3',
            ],
        );
        Premium::create(
            [
                'size' => '1',
                'price' => '58',
                'category_id' => "3",
            ],
        );
        Premium::create(
            [
                'size' => '2',
                'price' => '68',
                'category_id' => "3",
            ],
        );
    }
}
