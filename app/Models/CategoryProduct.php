<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $table = 'category_products';
    protected $primaryKey = 'id';

    public function assertCategoryProductData($payload) {
        return [
            'product_id' => $payload['product_id'],
            'category_id' => $payload['category_id']
        ];
    }
}
