<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='product';
    protected $fillable=['name', 'slug', 'description', 'characteristic', 
        'guide', 'ingredient', 'preservation', 'origin', 'price', 'isDiscount', 
        'discountPercent', 'isHot', 'isNew', 'storageQuantity', 'transportingQuantity', 
        'idBrand', 'idCategory', 'status', 'createdBy','createdDate'];
    public $timestamps=false;
}
