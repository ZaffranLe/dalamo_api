<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table='provider';
    protected $fillable=['name','createdBy','createdDate','status','address','phone', 'email', 'description'];
    public $timestamps=false;
}
