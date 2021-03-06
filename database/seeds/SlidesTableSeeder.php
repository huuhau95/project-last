<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class SlidesTableSeeder extends Seeder
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
            'banner04.jpg',
            'banner06.jpg',
            'banner07.jpg',
            'banner12.jpg',
        ];
        for ($i = 1; $i <= 4; $i++) {
            $data[] = [
                'name' => $faker->randomElement($images),
                'image' => $faker->randomElement($images),
            ];
        }
        DB::table('slides')->insert($data);
    }
}
