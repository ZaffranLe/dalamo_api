<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_receipt extends Model
{
    protected $table='order_receipt';
    protected $fillable=['address','idStatus','phone','name','createdBy','createdDate','isDeleted', 'idUser', 'totalPrice'];
    public $timestamps=false;
}
