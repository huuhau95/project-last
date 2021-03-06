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
            ], [
                'name' => 'Quan ao nam',
            ], [
                'name' => 'Giay dep nu',
            ], [
                'name' => 'Giay dep nam',
            ], [
                'name' => 'Vi nam',
            ], [
                'name' => 'Tui xach nu',
            ],
        ];
        DB::table('categories')->insert($data);
    }
}
