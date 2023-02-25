<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImageManagementTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_images()
    {
        $response = $this->json('GET', 'api/images', []);
        $response->assertStatus(200)
        ->assertJsonStructure(['code' => 'message'])
        ->assertJsonStructure(['code' => 'data']);
    }

    public function test_get_single_image()
    {
        $response = $this->json('GET', 'api/images/1', []);
        $response->assertStatus(200)
            ->assertJsonStructure(['code' => 'message'])
            ->assertJsonStructure(['code' => 'data']);
    }

    public function test_get_single_image_no_image()
    {
        $response = $this->json('GET', 'api/images/1000', []);
        $response->assertStatus(204);
    }

    public function test_create_image()
    {
        $payload = [
            'name' => 'test image 1',
            'file' => UploadedFile::fake()->create('test-image.jpg', 500),
            'enable' => true
        ];

        $response = $this->json('POST', 'api/images', $payload);
        $response->assertStatus(201)
        ->assertJsonStructure(['code' => 'message'])
        ->assertJsonStructure(['code' => 'data']);
    }
}
