<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
                'name' => 'Cafe',
                'image'=> 'coffee.svg',
            ], [
                'name' => 'Trà',
                'image'=> 'coffee-cup.svg',
            ], [
                'name' => 'Sinh Tố',
                'image'=> 'frappe.svg',
            ], [
                'name' => 'Soda - Mojito',
                'image'=> 'mocha.svg',
            ], [
                'name' => 'Nước Ép',
                'image'=> 'takeaway.svg',
            ], [
                'name' => 'Đồ Đá Xay',
                'image'=> 'tea-cup.svg',
            ],
        ];

        DB::table('categories')->insert($data);
    }
}
