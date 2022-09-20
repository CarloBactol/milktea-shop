<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create(
            [
                'name' => 'The Panda Tea',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestiae officiis temporibus ducimus totam autem asperiores vitae nulla quisquam obcaecati repellat.',
                'size_id' =>  '1',
                'status' =>  '1',
                'popular' =>  '1',
                'size_id' =>  '1',
                'qty' => '10',
                'image' => 'NULL',
            ],
        );

        Product::create(
            [
                'name' => 'Hubble Bubble Tea',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestiae officiis temporibus ducimus totam autem asperiores vitae nulla quisquam obcaecati repellat.',
                'size_id' =>  '1',
                'status' =>  '1',
                'popular' =>  '1',
                'size_id' =>  '1',
                'qty' => '20',
                'image' => 'NULL',
            ],
        );

        Product::create(
            [
                'name' => 'Infinitea',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestiae officiis temporibus ducimus totam autem asperiores vitae nulla quisquam obcaecati repellat.',
                'size_id' =>  '1',
                'status' =>  '1',
                'popular' =>  '1',
                'size_id' =>  '1',
                'qty' => '20',
                'image' => 'NULL',
            ],
        );

        Product::create(
            [
                'name' => 'Pearl’s Finest Teas',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestiae officiis temporibus ducimus totam autem asperiores vitae nulla quisquam obcaecati repellat.',
                'size_id' =>  '1',
                'status' =>  '1',
                'popular' =>  '1',
                'size_id' =>  '1',
                'qty' => '20',
                'image' => 'NULL',
            ],
        );
    }
}
