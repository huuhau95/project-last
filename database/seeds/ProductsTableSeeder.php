<?php

use Illuminate\Database\Seeder;
use App\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 15;
        for ($i = 0; $i < $limit; $i++) {
            $data[] = [
                'name' => 'Trà ' . $i,
                'price' => rand(10000, 40000),
                'brief' => 'this is brief',
                'description' => 'this is description' . rand(10000, 40000) . $i,
                'category_id' => 2,
                'quantity' => rand(50, 150),
            ];
        }
        for ($i = 0; $i < $limit; $i++) {
            $data[] = [
                'name' => 'Cafe ' . $i,
                'price' => rand(10000, 40000),
                'brief' => 'this is brief',
                'description' => 'this is description' . rand(10000, 40000) . $i,
                'category_id' => 1,
                'quantity' => rand(50, 150),
            ];
        }
        for ($i = 0; $i < $limit; $i++) {
            $data[] = [
                'name' => 'Soda - Daxo ' . $i,
                'price' => rand(10000, 40000),
                'brief' => 'this is brief',
                'description' => 'this is description' . rand(10000, 40000) . $i,
                'category_id' => 3,
                'quantity' => rand(50, 150),
            ];
        }
        for ($i = 0; $i < $limit; $i++) {
            $data[] = [
                'name' => 'Soda - Mizito ' . $i,
                'price' => rand(10000, 40000),
                'brief' => 'this is brief',
                'description' => 'this is description' . rand(10000, 40000) . $i,
                'category_id' => 4,
                'quantity' => rand(50, 150),
            ];
        }
        for ($i = 0; $i < $limit; $i++) {
            $data[] = [
                'name' => 'nước ép ' . $i,
                'price' => rand(10000, 40000),
                'brief' => 'this is brief',
                'description' => 'this is description' . rand(10000, 40000) . $i,
                'category_id' => 5,
                'quantity' => rand(50, 150),
            ];
        }
        for ($i = 0; $i < $limit; $i++) {
            $data[] = [
                'name' => 'trà sữa ' . $i,
                'price' => rand(10000, 40000),
                'brief' => 'this is brief',
                'description' => 'this is description' . rand(10000, 40000) . $i,
                'category_id' => 6,
                'quantity' => rand(50, 150),
            ];
        }
        DB::table('products')->insert($data);
    }
}
