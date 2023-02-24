<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';

    public function assertProductData($payload) {
        return [
            'name' => $payload['name'],
            'description' => $payload['description'],
            'enable' => $payload['enable']
        ];
    }
}
