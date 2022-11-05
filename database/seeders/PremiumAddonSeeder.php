<?php

namespace Database\Seeders;

use App\Models\PremiumAddon;
use Illuminate\Database\Seeder;

class PremiumAddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PremiumAddon::create(
            [
                'name' => 'Dark choco',
            ],
        );
        PremiumAddon::create(
            [
                'name' => 'Matcha',
            ],
        );
        PremiumAddon::create(
            [
                'name' => 'Milky strawberry',
            ],
        );
        PremiumAddon::create(
            [
                'name' => 'Dark cookies and cream',
            ],
        );
    }
}
