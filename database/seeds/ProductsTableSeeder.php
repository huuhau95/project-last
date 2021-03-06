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
                'name' => 'Quan ao nu ' . $i,
                'price' => rand(10000, 40000),
                'brief' => 'this is brief',
                'description' => 'this is description' . rand(10000, 40000) . $i,
                'category_id' => 1,
                'selling' => 1,
            ];
        }
        for ($i = 0; $i < $limit; $i++) {
            $data[] = [
                'name' => 'Quan ao nam ' . $i,
                'price' => rand(10000, 40000),
                'brief' => 'this is brief',
                'description' => 'this is description' . rand(10000, 40000) . $i,
                'category_id' => 2,
                'selling' => 1,
            ];
        }
        for ($i = 0; $i < $limit; $i++) {
            $data[] = [
                'name' => 'Giay dep nu ' . $i,
                'price' => rand(10000, 40000),
                'brief' => 'this is brief',
                'description' => 'this is description' . rand(10000, 40000) . $i,
                'category_id' => 3,
                'selling' => 1,
            ];
        }
        for ($i = 0; $i < $limit; $i++) {
            $data[] = [
                'name' => 'Giay dep nam ' . $i,
                'price' => rand(10000, 40000),
                'brief' => 'this is brief',
                'description' => 'this is description' . rand(10000, 40000) . $i,
                'category_id' => 4,
                'selling' => 1,
            ];
        }
        for ($i = 0; $i < $limit; $i++) {
            $data[] = [
                'name' => 'Vi nam ' . $i,
                'price' => rand(10000, 40000),
                'brief' => 'this is brief',
                'description' => 'this is description' . rand(10000, 40000) . $i,
                'category_id' => 5,
                'selling' => 1,
            ];
        }
        for ($i = 0; $i < $limit; $i++) {
            $data[] = [
                'name' => 'Tui xach nu ' . $i,
                'price' => rand(10000, 40000),
                'brief' => 'this is brief',
                'description' => 'this is description' . rand(10000, 40000) . $i,
                'category_id' => 6,
                'selling' => 1,
            ];
        }
        DB::table('products')->insert($data);
    }
}
