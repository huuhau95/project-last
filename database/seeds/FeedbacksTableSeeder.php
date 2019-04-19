<?php

use Illuminate\Database\Seeder;

class FeedbacksTableSeeder extends Seeder
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
                'user_id' => 1,
                'product_id' => 1,
                'content' => 'Hay Lam',
                'status' => 0,
            ],
        ];

        DB::table('feedbacks')->insert($data);
    }
}
