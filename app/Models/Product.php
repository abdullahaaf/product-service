<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['name','description','enable'];

    public $timestamps = false;

    public function assertProductData($payload)
    {
        return [
            'name' => $payload['name'],
            'description' => $payload['description'],
            'enable' => $payload['enable']
        ];
    }
}
