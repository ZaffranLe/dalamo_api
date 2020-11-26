<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OS extends Model
{
    protected $table='order_status';
    protected $fillable=['name', 'description', 'color', 'status', 'createdBy','createdDate'];
    public $timestamps=false;
}
