<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'file', 'enable'];

    public $timestamps = false;

    public function assertImageData($payload)
    {
        return [
            'name' => $payload['name'],
            'file' => $payload['file'],
            'enable' => $payload['enable']
        ];
    }
}
