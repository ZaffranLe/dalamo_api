<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UP extends Model
{
    protected $table='user_permission';
    protected $fillable=['idUser','idPermission'];
    public $timestamps=false;
}
