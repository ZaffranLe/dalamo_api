<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table='image';
    protected $fillable=['idProduct','fileId','name','size',
        'height','width','thumbnailUrl','filePath', 'createdDate'];
    public $timestamps=false;
}
