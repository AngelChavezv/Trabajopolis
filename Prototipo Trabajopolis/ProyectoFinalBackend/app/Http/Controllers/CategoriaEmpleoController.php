<?php

namespace App\Http\Controllers;

use App\CategoriaEmpleo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoriaEmpleoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $litaCategoriaEmpleo = CategoriaEmpleo::with('empleo','categoria')->get();
        return response()->json(["res" =>"succes","data"=>$litaCategoriaEmpleo]);
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
        $validator = Validator::make($request->all(), [
            'empleo_id' => ['required'],
            'categoria_id' => ['required']

        ]);
        if ($validator->fails()) {
            return response()->json(["res" => "error",
                "reason" => "validation",
                "messge" => $validator->messages()]);

        }
        $empleo_id = $request->empleo_id;
        if ($empleo_id == null) {
            return response()->json([
                "res" => "error",
                "message" => "eL campo empleo no existe"
            ]);
        }
        $categoria_id = $request->categoria_id;
        if ($categoria_id == null) {
            return response()->json([
                "res" => "error",
                "message" => "eL campo categoria no existe"
            ]);
        }
        $result = CategoriaEmpleo::with('empleo', 'categoria')
            ->where('empleo_id', '=', $empleo_id)
            ->where('categoria_id', '=', $categoria_id)
            ->get();

        if (!$result->isEmpty()) {
            return response()->json([
                "res" => "error",
                "message" => $result
            ]);

        } else
            if ($result->isEmpty()) {
                $objEmpleoCategoria = new CategoriaEmpleo();
                $objEmpleoCategoria->empleo_id = $empleo_id;
                $objEmpleoCategoria->categoria_id = $categoria_id;
                $objEmpleoCategoria->save();
                return response()->json([
                    "res" => "success",
                    "data" => $objEmpleoCategoria
                ]);


            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoriaEmpleo  $categoriaEmpleo
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $objEmpleoCategoria = CategoriaEmpleo::findOrFail($id);
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
     * @param  \App\CategoriaEmpleo  $categoriaEmpleo
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaEmpleo $categoriaEmpleo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoriaEmpleo  $categoriaEmpleo
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'empleo_id'=>['required'],
            'categoria_id'=>['required']

        ]);
        if($validator->fails()){
            return response()->json(["res"=>"error",
                "reason"=>"validation",
                "message"=>$validator->messages()]);

        }
        $objEmpleoCategoria = CategoriaEmpleo::with('empleo','categoria')->findOrFail($id);
        $empleo_id= $request->empleo_id;
        $categoria_id = $request->categoria_id;
        $objEmpleoCategoria->empleo_id = $empleo_id;
        $objEmpleoCategoria->categoria_id = $categoria_id;


        $objEmpleoCategoria->save();
        return response()->json([
            "res" =>"success",
            "data" =>$objEmpleoCategoria
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoriaEmpleo  $categoriaEmpleo
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $objEmpleoCategoria = CategoriaEmpleo::find($id);
        if($objEmpleoCategoria == null){
            return response()->json([
                'res'=>'error',
                'message'=>'la asignacion no existe'
            ]);
        }
        $objEmpleoCategoria->delete();
        return response()->json([
            'res'=>'success',
            'id'=>$id
        ]);
    }
}
