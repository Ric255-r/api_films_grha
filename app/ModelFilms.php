<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ModelFavourite;
use Auth;

class ModelFilms extends Model
{
    protected $table = 'tb_films';
    protected $primaryKey = 'id';
    protected $fillable = ['gambar_films','nama_films','status_films'];

    public function isFavourite() {
        return ModelFavourite::where('films_id', $this->id)
                            ->where('user_id', Auth::user()->id)
                            ->count() ? true : false;
    }

    // public function check_user(){
    //     return ModelFavourite::where('user_id', Auth::user()->id)->first() ? true : false;
    // }

    public function isFavourite2() {
        return ModelFavourite::where('films_id', $this->id)
                            ->where('user_id', Auth::user()->id)
                            ->count() ? true : false;
    }
}
