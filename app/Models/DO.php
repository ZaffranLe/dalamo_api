<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_order extends Model
{
    protected $table='detail_order';
    protected $fillable=['idReceipt','idProduct','quantity'];
    public $timestamps=false;
}
