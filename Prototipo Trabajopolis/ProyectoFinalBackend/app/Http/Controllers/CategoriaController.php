<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */



    public function index()
    {
        $listaCategorias = Categoria::all();
        return response()->json(['res' => 'success','data'=>$listaCategorias]);
    }
    public function categoriaIndex()
    {
        $listaCategorias = Categoria::all();
        return response()->json(['res' => 'success','data'=>$listaCategorias]);
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
            'nombre' => ['required','string']
        ]);
        if($validator->fails()){
            return response()->json(["res"=>"error",
                "reason"=>"validation",
                "message"=>$validator->messages()]);

        }

        $objCategoria = Categoria::create($request->all());
        return response()->json(["res"=>"success","data"=>$objCategoria]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $objCategoria = Categoria::find($id);
        if($objCategoria == null){
            return response()->json([
                "res" => "error",
                "message" =>"La Categoria no existe"
            ]);
        }
        return response()->json([
            "res" =>"success",
            "data"=>$objCategoria
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $objCategoria = Categoria::findOrFail($id);
        $nombre = $request->nombre;
        if($nombre == null){
            return response()->json([
                "res"=>"error",
                "message"=>"eL campo nombre no existe"
            ]);
        }
            $objCategoria->nombre = $nombre;
            $objCategoria->save();
        return response()->json([
            "res" =>"success",
            "data" =>$objCategoria
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $objCategoria = Categoria::find($id);
        if($objCategoria == null){
            return response()->json([
                'res'=>'error',
                'message'=>'La Categoria no existe'
            ]);
        }
        $objCategoria->delete();
        return response()->json([
            'res'=>'success',
            'id'=>$id
        ]);
    }
}
