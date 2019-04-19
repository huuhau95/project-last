<?php

use Illuminate\Database\Seeder;

class PotentialsTableSeeder extends Seeder
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
                'discount' => 3,
            ], [
                'discount' => 5,
            ], [
                'discount' => 10,
            ]
        ];

        DB::table('potentials')->insert($data);
    }
}
