<?php

namespace App\Http\Controllers;
use App\ModelFilms;
use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class FilmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function sedang_tayang()
    {

        return ModelFilms::where('status_films', 'sedang_tayang')->get();
    }


    public function coming_soon()
    {
        return ModelFilms::where('status_films', 'coming_soon')->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'gambar_films'=>'required|mimes:jpeg,jpg,bmp,png|max:5120',
            'nama_films'=>'required',
            'status_films'=>'required'
        ]);

        $file = $request->file('gambar_films');
        $nama_file = "Film=" . $file->getClientOriginalName();

        $tujuan_upload = 'gambar_films';
        $file->move($tujuan_upload, $nama_file);

        $arr_data = [
            'gambar_films'=>$nama_file,
            'nama_films'=>$request->nama_films,
            'status_films'=>$request->status_films
        ];

        $input = ModelFilms::create($arr_data);
        return 'Bisa Input';
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
        $request->validate([
            'gambar_films'=>'required',
            'nama_films'=>'required',
            'status_films'=>'required'
        ]);

        $file = $request->file('gambar_films');
        $nama_file = "Film=" . $file->getClientOriginalName();

        $tujuan_upload = 'gambar_films';
        $file->move($tujuan_upload, $nama_file);

        $arr_data = [
            'gambar_films'=>$nama_file,
            'nama_films'=>$request->nama_films,
            'status_films'=>$request->status_films
        ];

        $input = ModelFilms::where('id', $id)->update($arr_data);

        if($input){
            return 'sukses';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = ModelFilms::where('id', $id)->delete();
        if($delete){
            return 'Sukses Hapus';
        }else{
            return 'gagal';
        }
    }

    public function login()
    {
        try {
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['user_tidak_ditemukan'], 404);
            }
        }
        catch(TokenExpiredException $exception){
            return response()->json([
                'error'=>true,
                'message'=>'Token Expired'
            ], 401);

        }
        catch(TokenBlacklistedException $exception){
            return response()->json([
                'error'=>true,
                'message'=>'Token Terblacklist'
            ], 401);            
        }
        catch(TokenInvalidException $exception){
            return response()->json([
                'error'=>true,
                'message'=>'Token Invalid'
            ], 401);

        }
        catch(JWTException $exception){
            return response()->json([
                'error'=>true,
                'message'=>'Token Ilang'
            ], 500);
        }
    }
}
