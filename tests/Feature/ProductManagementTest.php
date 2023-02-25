<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_products()
    {
        $response = $this->json('GET', 'api/products', []);
        $response->assertStatus(200)
            ->assertJsonStructure(['code' => 'message'])
            ->assertJsonStructure(['code' => 'data']);
    }

    public function test_get_single_product()
    {
        $response = $this->json('GET', 'api/products/13', []);
        $response->assertStatus(200)
            ->assertJsonStructure(['code' => 'message'])
            ->assertJsonStructure(['code' => 'data']);
    }

    public function test_get_single_product_no_product()
    {
        $response = $this->json('GET', 'api/products/1000', []);
        $response->assertStatus(204);
    }

    public function test_create_product()
    {
        $payload = [
            'name' => 'test product',
            'description' => 'test description',
            'image' => 1,
            'category' => 1,
            'enable' => true
        ];

        $response = $this->json('POST', 'api/products', $payload);
        $response->assertStatus(201)
            ->assertJsonStructure(['code' => 'message'])
            ->assertJsonStructure(['code' => 'data']);
    }
}
