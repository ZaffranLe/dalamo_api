<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OS extends Model
{
    protected $table='order_status';
    protected $fillable=['name','createdBy','createdDate','isDeleted','updatedBy','updatedDate','deletedBy','deletedDate'];
    public $timestamps=false;
}
