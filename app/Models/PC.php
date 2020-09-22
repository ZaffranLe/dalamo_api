<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PC extends Model
{
    protected $table='product_category';
    protected $fillable=['idCategory','idProduct'];
    public $timestamps=false;
}
