<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='product';
    protected $fillable=['name','createdBy','createdDate','status','idBrand','price','ingredient','origin','isDiscount','isHot','isNew'];
    public $timestamps=false;
}
