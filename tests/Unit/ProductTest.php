<?php

namespace Tests\Unit;

use App\Product;
use App\Repositories\Repository;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get(route('client.product.detail', ['id' => 1]));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateProduct()
    {
        $modelProduct =  new Repository(new Product());

    }
}
