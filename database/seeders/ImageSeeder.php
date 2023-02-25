<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('images')->insert([
            'name' => 'image seeder',
            'file' => UploadedFile::fake()->create('test-image-seeeder.jph', 500),
            'enable' => true
        ]);
    }
}
