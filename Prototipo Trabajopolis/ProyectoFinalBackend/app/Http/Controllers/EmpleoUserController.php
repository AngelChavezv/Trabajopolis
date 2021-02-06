<?php

namespace App\Http\Controllers;
use App\Curriculum;
use App\Empleo;
use Illuminate\Support\Facades\Validator;
use App\EmpleoUser;
use Illuminate\Http\Request;
use DB;

class EmpleoUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $litaEmpleoUser = EmpleoUser::with('empleo','user')->get();
        return response()->json(["res" =>"succes","data"=>$litaEmpleoUser]);
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
            'user_id'=>['required'],
            'empleo_id'=>['required']
        ]);
        if($validator->fails()){
            return response()->json(["res"=>"error",
                "reason"=>"validation",
                "messge"=>$validator->messages()]);
        }

        $user_id = $request->user_id;
        if($user_id == null){
            return response()->json([
                "res"=>"error",
                "message"=>"eL campo usuario no existe"
            ]);
        }
        $empleo_id = $request->empleo_id;
        if($empleo_id == null){
            return response()->json([
                "res"=>"error",
                "message"=>"eL campo empleo no existe"
            ]);
        }
//        $result = DB::table('empleo_users')
//            ->select('id','user_id','empleo_id')
//            ->where('user_id',"=",$user_id,'and','empleo_id',"=",$empleo_id)
//            ->get();

        $result =EmpleoUser::with('user','empleo')
            ->where('empleo_id','=',$empleo_id)
            ->where('user_id','=',$user_id)
        ->get();

        $resultCurriculum = Curriculum::with('user')->where('user_id','=',$user_id)->get();


        if(!$result->isEmpty()) {
            return response()->json([
                "res" => "error",
                "message" =>$result
            ]);

        }else
            if($result->isEmpty())
           {
              if($resultCurriculum->isEmpty()){
                  return response()->json([
                      "res" => "error",
                      "message" =>$resultCurriculum
                  ]);
              }else
                  if(!$resultCurriculum->isEmpty()){
                      $objProducto = new EmpleoUser();
                      $objProducto->user_id = $user_id;
                      $objProducto->empleo_id = $empleo_id;
                      $objProducto->save();
                      return response()->json([
                          "res" =>"success",
                          "data" =>$objProducto
                      ]);
                  }



        }






//        $objEmpleoCategorias = EmpleoUser::create($request->all());
//        $id_ultimo_registro = $objEmpleoCategorias->id;
//        $objEmpleoCategoria = EmpleoUser::with('empleo','user')->find($id_ultimo_registro);
//
//        $idEmpleoUser= $objEmpleoCategoria->id;
//
//         if($objEmpleoCategoria == ""){
//             return response()->json(["res"=>"success","data"=>$objEmpleoCategoria]);
//         }else
//             {
//                 $flight = EmpleoUser::find($idEmpleoUser);
//                 $flight->delete();
//
//                 return response()->json([
//                     "res" => "error",
//                     "message" =>"Usted ya postulo a este empleo"
//                 ]);
//
//         }






    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpleoUser  $empleoUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $objEmpleoCategoria = EmpleoUser::with('user','empleo')
            ->where('user_id','=',$id)
            ->get();
        if($objEmpleoCategoria == null){
            return response()->json([
                "res" => "error",
                "message" =>"El asignacion no existe"
            ]);
        }
        return response()->json([
            "res" =>"success",
            "data"=>$objEmpleoCategoria
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpleoUser  $empleoUser
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpleoUser $empleoUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmpleoUser  $empleoUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpleoUser $empleoUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpleoUser  $empleoUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpleoUser $empleoUser)
    {
        //
    }
}
