<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table='property';
    protected $fillable=['name','value','idProduct'];
    public $timestamps=false;
}
