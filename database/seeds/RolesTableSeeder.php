<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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
                'name' => 'Admin',
            ], [
                'name' => 'Nhân Viên',
            ], [
                'name' => 'Khách Hàng',
            ],
        ];

        DB::table('roles')->insert($data);
    }
}
