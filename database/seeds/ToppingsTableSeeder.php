<?php

use Illuminate\Database\Seeder;

class ToppingsTableSeeder extends Seeder
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
                'name' => 'Trân châu đen',
                'price' => 10000,
                'quantity' => 130,
            ], [
                'name' => 'Thạch trái cây',
                'price' => 5000,
                'quantity' => 100,
            ], [
                'name' => 'Hạt thủy tinh',
                'price' => 1500,
                'quantity' => 150,
            ], [
                'name' => 'Thạch pudding',
                'price' => 12000,
                'quantity' => 100,
            ],
        ];

        DB::table('toppings')->insert($data);
    }
}
