<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name','enable'];

    public $timestamps = false;

    public function assertCategoryData($payload)
    {
        return [
            'name' => $payload['name'],
            'enable' => $payload['enable']
        ];
    }
}
