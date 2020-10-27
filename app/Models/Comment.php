<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comment';
    protected $fillable=['idUser','createdBy','createdDate','status','idProduct','rate'];
    public $timestamps=false;
}
