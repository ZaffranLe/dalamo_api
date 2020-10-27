<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IP extends Model
{
    protected $table='import_product';
    protected $fillable=['idProvider','createdBy','createdDate','importDate'];
    public $timestamps=false;
}
