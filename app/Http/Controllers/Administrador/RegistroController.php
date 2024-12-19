<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Geocerca;

use App\Models\Registro;
use App\Models\Inspeccion;
use App\Models\Pregunta;
use App\Models\Formulario;
use App\Models\Respuesta;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $filtros)
    {
        $fecha = isset($filtros->fecha) ? $filtros->fecha : date('Y-m-d');

        $registros = Registro::select('registros.id','medicos.nombres','medicos.apellidos','registros.tarde',DB::RAW("time(registros.checkin) as checkin"),
        DB::RAW("time(registros.checkout) as checkout"),'registros.latin','registros.lonin','geocercas.nombre','registros.latout','registros.out',
        DB::RAW("date(registros.created_at) as fecha"),'registros.id_medico')
        ->join('geocercas','geocercas.id','registros.id_geocerca')
        ->join('medicos','medicos.id','registros.id_medico')
        ->join('administradores','medicos.id_administrador','=','administradores.id')
        ->whereraw("date(registros.checkin) = '".$fecha."' and administradores.id='".GetId()."' " )
        ->orderby('checkin','asc')
        ->paginate(20);

        return view('administradores.registros.index',['registros'=>$registros,'filtros'=>$filtros]);
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

    function MiniMapa($lat,$lon){
        $marcadores = Geocerca::get();
        return view('administradores.registros.views.mapa',['marcadores'=>$marcadores,'lat'=>$lat,'lon'=>$lon]);
    }


    function VerFormulario($id){
        

        $inspeccion=Inspeccion::find($id);
        $encuesta=Formulario::find($inspeccion->id_formulario);
        $preguntas=Pregunta::where('id_formulario',$inspeccion->id_formulario)->orderby('orden','asc')->get();
        $respuestas=array();
        //return $this->GetRespuesta('22af4a6315134f1e995eed3ade0b3b2b','646deab591e24676a92075c78a7fc266');;
        for($i=0;$i<count($preguntas);$i++){
            $respuestas[$preguntas[$i]->id]=$this->GetRespuesta($preguntas[$i]->id,$id);
        }


        return view('administradores.registros.formulario',['inspeccion'=>$inspeccion,
        'encuesta'=>$encuesta,'preguntas'=>$preguntas,'respuestas'=>$respuestas,'id_inspeccion'=>$id,'id_formulario'=>$id]);

    }

    function GetRespuesta($id_pregunta,$id_inspeccion){
        //return $id_inspeccion.'        '.$id_pregunta;
        $respuesta = Respuesta::where('id_pregunta',$id_pregunta)->where('id_inspeccion',$id_inspeccion)->first();
        if(!$respuesta){
            return '' ;
        }
        return $respuesta->respuesta;

    }

   
}
