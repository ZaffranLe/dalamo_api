<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='product';
    protected $fillable=['name','createdBy','createdDate','isDeleted','idBrand','price','ingredient','origin','isDiscount'];
    public $timestamps=false;
}
