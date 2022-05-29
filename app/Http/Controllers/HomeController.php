<?php

namespace App\Http\Controllers;
use App\ModelFilms;
use Auth;
use DB;
use App\ModelFavourite;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;

        $sedang_tayang = ModelFilms::where('status_films', 'sedang_tayang')->get();

        // $sedang_tayang = DB::select("");
        $coming_soon = ModelFilms::where('status_films', 'coming_soon')->get();
        // $check_tayang = ModelFavourite::where('status_films', 'sedang_tayang')
        //                             ->where('user_id', $id)
        //                             ->get();

        // $check_tayang = DB::select("SELECT f.films_id, f.user_id, film.status_films, u.id AS IdUser FROM tb_favourite f JOIN tb_films film ON f.films_id = film.id JOIN users u ON f.user_id = u.id WHERE u.id = '$id' AND film.status_films = 'sedang_tayang'; ");

        $rating = DB::select("SELECT sum(rating) AS rating,films_id, count(user_id) AS jumlah_user from tb_rating GROUP BY films_id");

        $auth_rating = DB::select("SELECT user_id, films_id FROM tb_rating");

        return view('home', ['sedang_tayang'=>$sedang_tayang, 'rating'=>$rating, 'coming_soon'=>$coming_soon, 'auth_rating'=>$auth_rating]);
    }
}
