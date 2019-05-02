<?php

use Illuminate\Database\Seeder;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'order_id' => 1,
                'product_id' => 1,
                'product_price' => 25,
                'size' => 'M',
                'color' => 'Red',
                'quantity' => 8,
            ], [
                'order_id' => 1,
                'product_id' => 4,
                'product_price' => 25,
                'size' => 'M',
                'color' => 'Red',
                'quantity' => 4,
            ], [
                'order_id' => 2,
                'product_id' => 3,
                'product_price' => 25,
                'size' => 'M',
                'color' => 'Red',
                'quantity' => 2,
            ], [
                'order_id' => 2,
                'product_id' => 6,
                'product_price' => 25,
                'size' => 'M',
                'color' => 'Red',
                'quantity' => 1,
            ]
        ];

        DB::table('order_details')->insert($data);
    }
}
