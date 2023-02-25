<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryManagementTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_categories()
    {
        $response = $this->json('GET', 'api/categories', []);
        $response->assertStatus(200)
            ->assertJsonStructure(['code' => 'message'])
            ->assertJsonStructure(['code' => 'data']);
    }

    public function test_get_single_category()
    {
        $response = $this->json('GET', 'api/categories/1', []);
        $response->assertStatus(200)
            ->assertJsonStructure(['code' => 'message'])
            ->assertJsonStructure(['code' => 'data']);
    }

    public function test_get_single_category_no_category()
    {
        $response = $this->json('GET', 'api/categories/1000', []);
        $response->assertStatus(204);
    }

    public function test_create_category()
    {
        $payload = [
            'name' => 'test category',
            'enable' => true
        ];

        $response = $this->json('POST', 'api/categories', $payload);
        $response->assertStatus(201)
            ->assertJsonStructure(['code' => 'message'])
            ->assertJsonStructure(['code' => 'data']);
    }
}
