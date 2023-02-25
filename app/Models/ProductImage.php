<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id','image_id'];

    public $timestamps = false;

    public function assertProductImageData($payload)
    {
        return [
            'product_id' => $payload['product_id'],
            'image_id' => $payload['image']
        ];
    }

    public function getProductImageByProductId($productId)
    {
        return DB::table('product_images')
        ->where('product_images.product_id','=',$productId)
        ->join('images', 'product_images.image_id','=','images.id')
        ->select('images.name','images.file')
        ->get();
    }
}
