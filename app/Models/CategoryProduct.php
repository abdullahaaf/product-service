<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $table = 'category_products';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id','category_id'];

    public $timestamps = false;

    public function assertCategoryProductData($payload)
    {
        return [
            'product_id' => $payload['product_id'],
            'category_id' => $payload['category']
        ];
    }

    public function getProductCategoryByProductId($productId)
    {
        return DB::table('category_products')
            ->where('category_products.product_id', '=', $productId)
            ->join('categories', 'category_products.category_id', '=', 'categories.id')
            ->select('categories.name')
            ->get();
    }
}
