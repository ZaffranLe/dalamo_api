<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DIP extends Model
{
    protected $table='detail_import_product';
    protected $fillable=['idReceipt','idProduct','quantity'];
    public $timestamps=false;
}
