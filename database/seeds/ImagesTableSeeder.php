<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $data = [];
        $images = [
            '1.jpg',
            '2.jpg',
            '3.jpg',
            '4.jpg',
            '5.jpg',
            '6.jpg',
            '7.jpg',
            '8.jpg',
            '9.jpg',
            '10.jpg',
            '12.jpg',
            '13.jpg',
            '15.jpg',
            '17.jpg',
            '18.jpg',
            '19.jpg',
            '20.jpg',
            '21.jpg',
            '22.jpeg',
            '23.jpg',
            '24.jpg',
            '25.jpeg',
            '26.jpeg',
            '27.jpg'
        ];
        for ($i = 1; $i <= 150; $i++) {
            $data[] = [
                'product_id' => $i,
                'name' => $faker->randomElement($images),
            ];
        }
        DB::table('images')->insert($data);
    }
}
