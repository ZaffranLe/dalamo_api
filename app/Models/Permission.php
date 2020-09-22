<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table='permission';
    protected $fillable=['name','createdBy','createdDate','isDeleted'];
    public $timestamps=false;
}
