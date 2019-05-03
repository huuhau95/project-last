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
                'name' => 'Quan ao nu',
                'image'=> 'banner04.jpg',
            ], [
                'name' => 'Quan ao nam',
                'image'=> 'banner04.jpg',
            ], [
                'name' => 'Giay dep nu',
                'image'=> 'banner04.jpg',
            ], [
                'name' => 'Giay dep nam',
                'image'=> 'banner06.jpg',
            ], [
                'name' => 'Vi nam',
                'image'=> 'banner07.jpg',
            ], [
                'name' => 'Tui xach nu',
                'image'=> 'banner12.jpg',
            ],
        ];
        DB::table('categories')->insert($data);
    }
}
