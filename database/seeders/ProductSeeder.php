<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => 'test product seeder',
            'description' => 'test description seeder',
            'enable' => true
        ]);

        DB::table('category_products')->insert([
            'product_id' => 1,
            'category_id' => 1
        ]);

        DB::table('product_images')->insert([
            'product_id' => 1,
            'image_id' => 1
        ]);
     }
}
