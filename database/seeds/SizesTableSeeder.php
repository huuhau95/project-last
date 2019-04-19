<?php

use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
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
                'name' => 'M',
                'percent' => 1,
            ], [
                'name' => 'L',
                'percent' => 4.2,
            ], [
                'name' => 'X',
                'percent' => 5,
            ], [
                'name' => 'M-L',
                'percent' => 10,
            ]
        ];

        DB::table('sizes')->insert($data);
    }
}
