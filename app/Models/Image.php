<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $primaryKey = 'id';

    public function assertImageData($payload) {
        return [
            'name' => $payload['name'],
            'file' => $payload['file'],
            'enable' => $payload['enable']
        ];
    }
}
