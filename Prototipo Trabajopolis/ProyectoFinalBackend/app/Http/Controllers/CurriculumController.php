<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $listaCurriculum = Curriculum::with('user','ciudad')->get();
        return response()->json(['res'=>'success','data'=>$listaCurriculum]);
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
        'ciudad_id'=>['required'],
        'trabajos' => ['required','string'],
        'logros'=>['required','string'],
        'profesion'=>['required', 'string'],
        'telefono'=>['required','numeric'],
        'fechadenacimiento'=>['required'],


    ]);
    if($validator->fails()){
        return response()->json(["res"=>"error",
            "reason"=>"validation",
            "messge"=>$validator->messages()]);

    }

    $objCurriculums = Curriculum::create($request->all());
    $id_ultimo_registro = $objCurriculums->id;
    $objCurriculum = Curriculum::with('user','ciudad')->find($id_ultimo_registro);


    return response()->json(["res"=>"success","data"=>$objCurriculum]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curriculum  $curriculum
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $objCurriculum = Curriculum::findOrFail($id);
        if($objCurriculum == null){
            return response()->json([
                "res" => "error",
                "message" =>"El curriculum no existe"
            ]);
        }
        return response()->json([
            "res" =>"success",
            "data"=>$objCurriculum
        ]);
    }
    public function curriculumId($id)
    {
        $objCurriculum = Curriculum::with('user','ciudad')->where('user_id','=',$id)->get();
        if($objCurriculum == null){
            return response()->json([
                "res" => "error",
                "message" =>"El curriculum no existe"
            ]);
        }
        return response()->json([
            "res" =>"success",
            "data"=>$objCurriculum
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function edit(Curriculum $curriculum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curriculum  $curriculum
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'user_id'=>['required'],
            'ciudad_id'=>['required'],
            'trabajos' => ['required','string'],
            'logros'=>['required','string'],
            'profesion'=>['required', 'string'],
            'telefono'=>['required','numeric'],
            'fechadenacimiento'=>['required'],

        ]);
        if($validator->fails()){
            return response()->json(["res"=>"error",
                "reason"=>"validation",
                "message"=>$validator->messages()]);

        }
        $objCurriculum = Curriculum::with('user','ciudad')->findOrFail($id);
        $usuario_id = $request->user_id;
        $ciudad_id= $request->ciudad_id;
        $trabajos = $request->trabajos;
        $logros = $request->logros;
        $profesion = $request->profesion;
        $telefono = $request->telefono;
        $fechanacimiento = $request->fechadenacimiento;

        $objCurriculum->user_id = $usuario_id;
        $objCurriculum->ciudad_id = $ciudad_id;
        $objCurriculum->trabajos = $trabajos;
        $objCurriculum->logros = $logros;
        $objCurriculum->profesion = $profesion;
        $objCurriculum->telefono = $telefono;
        $objCurriculum->fechadenacimiento = $fechanacimiento;

        $objCurriculum->save();
        return response()->json([
            "res" =>"success",
            "data" =>$objCurriculum
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $objCurriculum = Curriculum::find($id);
        if($objCurriculum == null){
            return response()->json([
                'res'=>'error',
                'message'=>'El empleo no existe'
            ]);
        }
        $objCurriculum->delete();
        return response()->json([
            'res'=>'success',
            'id'=>$id
        ]);
    }
}
