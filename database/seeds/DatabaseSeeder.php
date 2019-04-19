<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PotentialsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SizesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ToppingsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderDetailsTableSeeder::class);
        $this->call(OrderDetailToppingTableSeeder::class);
        $this->call(FeedbacksTableSeeder::class);

    }
}
