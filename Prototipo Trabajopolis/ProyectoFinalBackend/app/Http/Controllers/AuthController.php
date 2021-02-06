<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;
class AuthController extends Controller
{

    public function login (Request $request){
        $loginData = $request->validate([
            'email'=>'email|required',
            'password'=>'required'
        ]);
        if(!auth()->attempt($loginData)){
            return response(['message' =>'Invalid Credentials','res'=>'error']);
        }

        $email = $request->email;

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
//        $role =DB::table('users')
//            ->join('roles','users.id','=','roles.id')
//            ->select('roles.name')
//            ->where('users.email','=',$email)
//            ->get();


       $rolAsignado = User::with('roles')->where('email','=',$email)->get();
        $rol = $rolAsignado[0]->roles[0]->name;



        return response(['rol'=>$rol,'user'=>auth()->user(),'access_token'=>$accessToken,'res'=>'success']);
    }


}
