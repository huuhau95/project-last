<?php

use Illuminate\Database\Seeder;

class OrderDetailToppingTableSeeder extends Seeder
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
                'order_detail_id' => 1,
                'topping_id' => 1,
                'topping_price' => 5,
            ], [
                'order_detail_id' => 2,
                'topping_id' => 3,
                'topping_price' => 5,
            ], [
                'order_detail_id' => 3,
                'topping_id' => 1,
                'topping_price' => 5,
            ], [
                'order_detail_id' => 1,
                'topping_id' => 2,
                'topping_price' => 5,
            ], [
                'order_detail_id' => 1,
                'topping_id' => 3,
                'topping_price' => 5,
            ], [
                'order_detail_id' => 1,
                'topping_id' => 4,
                'topping_price' => 5,
            ],
        ];

        DB::table('order_detail_topping')->insert($data);
    }
}
