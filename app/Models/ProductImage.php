<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';
    protected $primaryKey = 'id';

    public function assertProductImageData($payload) {
        return [
            'product_id' => $payload['product_id'],
            'image_id' => $payload['image_id']
        ];
    }
}
