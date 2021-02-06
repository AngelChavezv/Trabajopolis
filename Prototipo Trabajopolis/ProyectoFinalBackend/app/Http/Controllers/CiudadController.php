<?php

namespace App\Http\Controllers;

use App\Ciudad;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaCiudades = Ciudad::all();
        return response()->json(['res' => 'succes','data'=>$listaCiudades]);
    }

    public function ciudadIndex()
    {
        $listaCiudades = Ciudad::all();
        return response()->json(['res' => 'succes','data'=>$listaCiudades]);
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

        $objCiudad = Ciudad::create($request->all());
        return response()->json(["res"=>"success","data"=>$objCiudad]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $objCiudad = Ciudad::findOrFail($id);
        if($objCiudad == null){
            return response()->json([
                "res" => "error",
                "message" =>"La Ciudad no existe"
            ]);
        }
        return response()->json([
            "res" =>"success",
            "data"=>$objCiudad
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ciudad $ciudad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $objCiudad = Ciudad::findOrFail($id);
        $nombre = $request->nombre;
        if($nombre == null){
            return response()->json([
                "res"=>"error",
                "message"=>"eL campo nombre no existe"
            ]);
        }
        $objCiudad->nombre = $nombre;
        $objCiudad->save();
        return response()->json([
            "res" =>"success",
            "data" =>$objCiudad
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $objCiudad = Ciudad::find($id);
        if($objCiudad == null){
            return response()->json([
                'res'=>'error',
                'message'=>'La Ciudad no existe'
            ]);
        }
        $objCiudad->delete();
        return response()->json([
            'res'=>'success',
            'id'=>$id
        ]);
    }
}
