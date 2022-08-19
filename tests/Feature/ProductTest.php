<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;


class ProductTest extends TestCase
{
    /**
     * Prueba unitaria para metodo show del api productos.
     *
     * @return void
     */
    public function test_show()
    {

        $product = Product::factory()->create();
        $this->get(route('products.show', $product->id))->assertStatus(200);
    }
}
