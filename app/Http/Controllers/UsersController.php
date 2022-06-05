<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use DB;
use App\ModelRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['Error'=>'Gagal Login'], 400);
            }
        }catch (JWTException $e){
            return response()->json(['Error'=>'Tidak Dapat Membuat TOken'], 500);
        }

        return response()->json(['token'=> $token, 'User'=>Auth::user()->username]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'username'=>$request->username,
            'password'=>Hash::make($request->password),
            'status_user'=>'USERS'
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['user'=>$user, 'token'=>$token], 201);

    }

    public function getAuthenticatedUser()
    {
        try {
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['user_tidak_ditemukan'], 404);
            }
        }catch (TokenExpiredException $e){
            return response()->json(['Token_Expired'], $e->getStatusCode());
        }catch (TokenInvalidException $e){
            return response()->json(['Token_Invalid'], $e->getStatusCode());
        }catch (JWTException $e){
            return response()->json(['Token_Tidak_Ada'], $e->getStatusCode());        
        }

        return response()->json(['users'=>$user]);
    }

    public function me()
    {
        // $jwt = JWTAuth::toUser('');
        // return $token;
        return JWTAuth::parseToken()->authenticate();
        // return Auth::user()->username;
    }
    
    public function logout(Request $request)
    {
        $token = $request->header('Authorization');

        try {
            JWTAuth::parseToken()->invalidate($token);

            return response()->json([
                'Error'=>false,
                'message'=>'Sukses Logout'
            ], 200);
            
        }catch(TokenExpiredException $exception){
            return response()->json([
                'error'=>true,
                'message'=>'Token Expired'
            ], 401);

        }catch(TokenInvalidException $exception){
            return response()->json([
                'error'=>true,
                'message'=>'Token Invalid'
            ], 401);

        }catch(JWTException $exception){
            return response()->json([
                'error'=>true,
                'message'=>'Token Ilang'
            ], 500);
        }

    }

    public function index()
    {
        $id = Auth::user()->id; 

        $fav = DB::select("SELECT f.films_id, f.user_id, film.gambar_films, film.nama_films, film.status_films FROM tb_favourite f JOIN tb_films film ON f.films_id = film.id WHERE f.user_id = '$id' ");

        $rating = DB::select("SELECT r.*, film.gambar_films, film.nama_films FROM tb_rating r JOIN tb_films film ON r.films_id = film.id WHERE r.user_id = '$id'");

        return view('users.index', ['fav'=>$fav, 'rating'=>$rating]);
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
        //
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
        //
    }
}
