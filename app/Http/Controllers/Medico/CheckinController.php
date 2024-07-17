<?php

namespace App\Http\Controllers\Medico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Registro;
use App\Models\Formulario;
use App\Models\Pregunta;
use App\Models\Inspeccion;
use App\Models\Respuesta;
use App\Models\Geocerca;
use App\Models\Medico;
class CheckinController extends Controller
{

    public function __construct(){
        $this->middleware('mdlog');
    }


    function index(){
        $marcadores = Geocerca::get();
        $registro = Registro::where('id_medico',GetId())->whereraw("date(created_at) = date(now())")->first();
        if(!$registro){
            $registro = new Registro();
        }

        $formulario=Formulario::first();
        

        $preguntas = array();

        if(! Inspeccion::where('id_medico',GetId())->whereraw("date(created_at) = date(now())")->first() ){
            $preguntas=Pregunta::where('id_formulario',$formulario->id)->orderby('orden','asc')->get();
        }


        //return view('inspecciones.inspecciones.create_link',['encuesta'=>$encuesta,'preguntas'=>$preguntas,'id_encuesta'=>$id,'id_inspector'=>$id_inspector]);


        return view('medicos.checkin.index',['registro'=>$registro,'preguntas'=>$preguntas,
        'id_formulario'=>$formulario->id,
        'marcadores'=>$marcadores]);
    }

    function Checkin(Request $request){
        $geocerca = Geocerca::whereraw(" SQRT(POW(lat-(".$request->lat."),2)+POW(lon-(".$request->lon."),2)) <= (select distancia from configuraciones)")->first();
        if(!$geocerca){
            return redirect('check')->with('error','No está cerca de ninguna UM.');
        }

        $medico = Medico::select(DB::RAW("(time(now()) > entrada) as tarde"))->where('id' ,GetId())->first();
        if(!Registro::where('id_medico',GetId())->whereraw("date(created_at) = date(now())")->first()){
            $registro = new Registro();
            $registro->id = GetUuid();
            $registro->id_medico=GetId();
            $registro->id_geocerca=$geocerca->id;
            $registro->checkin = GetDateTimeNow();            
            $registro->latin = $request->lat;            
            $registro->lonin = $request->lon;  

            $registro->checkout = GetDateTimeNow();
            $registro->latout = '';            
            $registro->lonout = '';


            $registro->in = '1';            
            $registro->out = '0';
            $registro->tarde = $medico->tarde;
            $registro->save();
            return redirect('check')->with('success','Se realizó correctamente el checkin.');
        }else{
            return redirect('check')->with('error','El checkin ya se habia realizado.');
        }
       

        

    }

    function Checkout(Request $request){
        $registro =  Registro::where('id_medico',GetId())->whereraw("date(created_at) = date(now())")->first();       
        if($registro){
           
            $registro->checkout = GetDateTimeNow();
            $registro->latout = $request->lat;
            $registro->lonout = $request->lon;
            $registro->out = '1';
            $registro->save();

            return redirect('check')->with('success','Se realizó correctamente el checkout.');
        }else{
            return redirect('check')->with('error','No se ha hecho checkin.');
        }
        
    }

    function GuardarEncuesta(Request $request){

        //return $request;
        $id_inspeccion=GetUuid();
        //Primero se crea la inspeccion y despues las respuestas 
        $inspeccion=new Inspeccion();
        
        $inspeccion->id=$id_inspeccion;
        $inspeccion->id_medico=GetId();
        $inspeccion->id_formulario=$request->id_formulario;
        $inspeccion->save();
        
        $preguntas=explode(",",$request->preguntas);
        


        for($i=0;$i<count($preguntas);$i++){
            $respuesta=new Respuesta();

            $respuesta->id=GetUuid();
            $respuesta->id_inspeccion=$id_inspeccion;
            $respuesta->id_pregunta=$preguntas[$i];
            $respuesta->respuesta=$request->pregunta[$i];
            $respuesta->save();
            

            
        }



        if(isset($request->fotos) && $request->fotos!=''){
            $fotos=explode(",",$request->fotos);
            for($i=0;$i<count($fotos);$i++){

                $nomfoto=GetUuid();
                
                if(!GuardarArchivos($request->foto[$i],'/images/inspecciones/evidencia',$nomfoto.'.jpg')){
                    return Redirect::back()->with('error', 'Error al guardar fotos, comuniquese con soporte.');
                }

                

                $respuesta=new Respuesta();

                $respuesta->id=GetUuid();
                $respuesta->id_inspeccion=$id_inspeccion;
                $respuesta->id_pregunta=$fotos[$i];
                $respuesta->respuesta=$nomfoto;
                $respuesta->save();
                

                
            }
        }
        
        return redirect('check')->with('success', 'Se guardó la encuesta.');

        

       


       
    }

}
