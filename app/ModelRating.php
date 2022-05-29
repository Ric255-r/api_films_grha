<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelRating extends Model
{
    protected $table = 'tb_rating';
    protected $fillable = ['films_id','user_id','rating','pesan'];
}
