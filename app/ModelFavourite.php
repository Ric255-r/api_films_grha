<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelFavourite extends Model
{
    protected $table = 'tb_favourite';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','films_id'];
}
