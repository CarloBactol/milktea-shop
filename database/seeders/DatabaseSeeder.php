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
    }
}
