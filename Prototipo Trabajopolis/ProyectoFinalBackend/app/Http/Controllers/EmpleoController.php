<?php

namespace App\Http\Controllers;
use App\CategoriaEmpleo;
use Illuminate\Support\Facades\Validator;
use App\Empleo;
use App\Ciudad;
use Illuminate\Http\Request;
use DB;

class EmpleoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $listaEmpleos = Empleo::with('ciudad')->get();

        return response()->json(['res' => 'succes','data'=>$listaEmpleos]);

    }
    public function empleoIndex()
    {
        $listaEmpleos = Empleo::with('ciudad')->get();

        return response()->json(['res' => 'succes','data'=>$listaEmpleos]);

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
            'titulo' => ['required','string'],
            'descripcion'=>['required','string'],
            'empresa'=>['required', 'string'],
            'fecha'=>['required'],
            'telefono'=>['required','numeric'],
            'correocontacto'=>['required', 'string', 'email', 'max:255'],
            'user_id'=>['required'],
            'ciudad_id'=>['required']

        ]);
        if($validator->fails()){
            return response()->json(["res"=>"error",
                "reason"=>"validation",
                "message"=>$validator->messages()]);

        }

        $objEmpleos = Empleo::create($request->all());
        $id_ultimo_registro = $objEmpleos->id;
        $objEmpleo = Empleo::with('ciudad')->find($id_ultimo_registro);

        return response()->json(["res"=>"success","data"=>$objEmpleo]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleo  $empleo
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $objEmpleo = Empleo::with('ciudad')->findOrFail($id);
        if($objEmpleo == null){
            return response()->json([
                "res" => "error",
                "message" =>"El empleo no existe"
            ]);
        }
        return response()->json([
            "res" =>"success",
            "data"=>$objEmpleo
        ]);
    }
    public function empleoId($id)
    {
        $objEmpleo = Empleo::with('ciudad')->where('id','=',$id)->get();
        if($objEmpleo == null){
            return response()->json([
                "res" => "error",
                "message" =>"El curriculum no existe"
            ]);
        }
        return response()->json([
            "res" =>"success",
            "data"=>$objEmpleo
        ]);
    }
    public function empleoIdCreador($id)
    {
        $objEmpleo = Empleo::with('ciudad')->where('user_id','=',$id)->get();
        if($objEmpleo == null){
            return response()->json([
                "res" => "error",
                "message" =>"El curriculum no existe"
            ]);
        }
        return response()->json([
            "res" =>"success",
            "data"=>$objEmpleo
        ]);
    }
    public function empleoBuscador(Request $request)
    {

        $categoria = $request->categoria_id;
        $fecha = $request->fecha;
        $titulo = $request->titulo;

//        $objBusqueda = CategoriaEmpleo::with('categoria','empleo')
//            ->orWhere('categoria_id','like',"%$categoria%")
//            ->orWhere('empleo.fecha','like',"%$fecha%")
//            ->orWhere('empleo.titulo','like',"%$titulo%")
//            ->get();

//        $objBusqueda = DB::table('empleos')
//            ->join('categoria_empleos','categoria_empleos.empleo_id','=','empleos.id')
//            ->join('categorias','categoria_empleos.categoria_id','=','categoria_id')
//            ->select('empleos.id','empleos.titulo','empleos.descripcion','empleos.empresa','empleos.fecha',
//                'empleos.telefono',
//                'empleos.correocontacto',
//                'empleos.user_id',
//                'empleos.ciudad_id')
//            ->where('empleos.titulo','LIKE',"$titulo%",'and','categoria_id','LIKE',"$categoria%",'and',
//            'empleos.fecha','LIKE',"$fecha%")->get();
//        $objBusqueda= Empleo::with('ciudad')
//            ->orwhere('titulo','LIKE','%'.$titulo.'%')
//            ->orwhere('fecha','=',$fecha)->get();
        $objBusqueda=Empleo::with('ciudad')
            ->titulo($titulo)
            ->fecha($fecha)->get();


            return response()->json([
                "res" =>"success",
                "data"=>$objBusqueda
            ]);


        }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleo  $empleo
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleo $empleo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleo  $empleo
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'titulo' => ['required','string'],
            'descripcion'=>['required','string'],
            'empresa'=>['required', 'string'],
            'fecha'=>['required'],
            'telefono'=>['required','numeric'],
            'correocontacto'=>['required', 'string', 'email', 'max:255'],
           'user_id'=>['required'],
            'ciudad_id'=>['required']


        ]);
        if($validator->fails()){
            return response()->json(["res"=>"error",
                "reason"=>"validation",
                "message"=>$validator->messages()]);

        }
        $objEmpleo = Empleo::with('ciudad')->findOrFail($id);
        $titulo = $request->titulo;
        $descripcion = $request->descripcion;
        $empresa = $request->empresa;
        $fecha = $request->fecha;
        $telefono = $request->telefono;
        $correocontacto = $request->correocontacto;
        $user_id =  $request->user_id;
        $ciudad_id= $request->ciudad_id;

        $objEmpleo->titulo = $titulo;
        $objEmpleo->descripcion = $descripcion;
        $objEmpleo->empresa = $empresa;
        $objEmpleo->fecha = $fecha;
        $objEmpleo->telefono = $telefono;
        $objEmpleo->correocontacto = $correocontacto;
        $objEmpleo->user_id = $user_id;
        $objEmpleo->ciudad_id = $ciudad_id;
        $objEmpleo->save();
        return response()->json([
            "res" =>"success",
            "data" =>$objEmpleo
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleo  $empleo
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $objEmpleo = Empleo::find($id);
        if($objEmpleo == null){
            return response()->json([
                'res'=>'error',
                'message'=>'El empleo no existe'
            ]);
        }
        $objEmpleo->delete();
        return response()->json([
            'res'=>'success',
            'id'=>$id
        ]);
    }
}
