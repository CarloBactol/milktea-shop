<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AdminUserSeeder::class);
        $this->call(CustomerUserSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(BotleSizeSeeder::class);
        $this->call(AddOnsSeeder::class);
        $this->call(DistanceSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PremiumSeeder::class);
        $this->call(PremiumAddonSeeder::class);
        $this->call(ShippingFeeSeeder::class);
        $this->call(MileFeeSeeder::class);
    }
}
