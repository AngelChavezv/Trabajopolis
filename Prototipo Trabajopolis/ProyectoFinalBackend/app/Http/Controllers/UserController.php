<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaUsers = User::all();
        return response()->json(['res' => 'succes','data'=>$listaUsers]);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],


        ]);
        if($validator->fails()){
            return response()->json(["res"=>"error",
                "reason"=>"validation",
                "message"=>$validator->messages()]);

        }


        $objUser = new User();
        $objUser->name = $request->get('name');
        $objUser->email = $request->get('email');
        $objUser->password = Hash::make(($request->get('password')));
        $objUser->save();

        $objUser->assignRole('empleado');
        return response()->json(["res"=>"success","data"=>$objUser]);
    }
    public function storeSolicitante(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],


        ]);
        if($validator->fails()){
            return response()->json(["res"=>"error",
                "reason"=>"validation",
                "message"=>$validator->messages()]);

        }

//        $objUsuario = Usuario::create($request->all());
        $objUser = new User();
        $objUser->name = $request->get('name');
        $objUser->email = $request->get('email');
        $objUser->password = Hash::make(($request->get('password')));
        $objUser->save();
        $objUser->assignRole('Solicitante');

        return response()->json(["res"=>"success","data"=>$objUser]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $objUser = User::find($id);
        if($objUser == null){
            return response()->json([
                "res" => "error",
                "message" =>"El usuario no existe"
            ]);
        }
        return response()->json([
            "res" =>"success",
            "data"=>$objUser
        ]);
    }

    public function showId($id)
    {
        $objUser = User::find($id);
        if($objUser == null){
            return response()->json([
                "res" => "error",
                "message" =>"El usuario no existe"
            ]);
        }
        return response()->json([
            "res" =>"success",
            "data"=>$objUser
        ]);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'password' => ['required', 'string', 'min:8'],



        ]);
        if($validator->fails()){
            return response()->json(["res"=>"error",
                "reason"=>"validation",
                "message"=>$validator->messages()]);

        }
        $objUser = User::findOrFail($id);
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);
        $objUser->name = $name;
        $objUser->email = $email;
        $objUser->password = $password;
        $objUser->save();
        return response()->json([
            "res" =>"success",
            "data" =>$objUser
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $objUser = User::find($id);
        if($objUser == null){
            return response()->json([
                'res'=>'error',
                'message'=>'El usuario no existe'
            ]);
        }
        $objUser->delete();
        return response()->json([
            'res'=>'success',
            'id'=>$id
        ]);
    }
}
