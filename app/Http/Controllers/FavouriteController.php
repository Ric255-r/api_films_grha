<?php

namespace App\Http\Controllers;
use App\ModelFavourite;
use Illuminate\Http\Request;
use Auth;
use DB;
use JWTAuth;
use Tymon\JWTAuth\Exceptions;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;


class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;

        $tampil = DB::select("SELECT fav.id, u.username, films.nama_films FROM tb_favourite fav JOIN users u ON fav.user_id = u.id JOIN tb_films films ON fav.films_id = films.id WHERE u.id = '$id'");

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'films_id'=>'required'
        ]);
        $bnr = ModelFavourite::create($request->all());
        if($bnr){
            return 'Bisa';
        }else{
            return 'gagal';
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lala = ModelFavourite::where('films_id', $id)->delete();
        if($lala){
            return 'Bisa Hapus';
        }
    }
}
