<?php

namespace Database\Seeders;

use App\Models\Distance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DistanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Distance::create(
            [
                'user_id' => '1',
                'email' => 'admin@gmail.com',
                'name' => '0.9'
            ],
        );
    }
}
