<?php

namespace Database\Seeders;

use App\Models\ShippingFee;
use Illuminate\Database\Seeder;

class ShippingFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShippingFee::create([
            'shipping' => '100',
            'user_id' => '1'
        ]);
    }
}
