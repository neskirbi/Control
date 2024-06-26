<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use App\Models\Formulario;
use App\Models\Pregunta;

class FormularioController extends Controller
{

    public function __construct(){
        $this->middleware('adlog');
    }

    
    function index(){
        $formularios=Formulario::where('id_administrador',GetId())->paginate(15);


        return view('administradores.formularios.index',['formularios'=>$formularios]);
    }


    function create(Request $request){
        if(!isset($request->id)){            
            return redirect('formularios/create'.'?id='.GetUuid())->with('success','Se creo nueva formulario.');
        }        

        $formulario=Formulario::find($request->id);
        $preguntas=Pregunta::where('id_formulario',$request->id)->orderby('orden','asc')->get();
        return view('administradores.formularios.create',['formulario'=>$formulario,'preguntas'=>$preguntas,'id'=>$request->id]);
    }

    function store(Request $request){
        if(!Formulario::find($request->id)){
            $formulario=new Formulario();
            $formulario->id_administrador = GetId();
            $formulario->id=$request->id;
            $formulario->save();
        }

        if(Pregunta::where('id_formulario',$request->id)->where('tipo',$request->tipo)->first() && ($request->tipo*1)==5){
            return redirect('formularios/create'.'?id='.$request->id)->with('error','No se pueden agregar mas 1 ubicación.');
        }

       $pregunta=new Pregunta();
       $pregunta->id=GetUuid();
       $pregunta->tipo=$request->tipo;
       $pregunta->id_formulario=$request->id;
       $pregunta->pregunta=isset($request->pregunta) ? $request->pregunta : '';
       $pregunta->opciones=isset($request->opciones) ? $request->opciones : '';
       $pregunta->orden=$request->orden;
       $pregunta->save();

       return redirect('formularios/create'.'?id='.$request->id)->with('success','Se creo nueva formulario.');
    }


    function destroy($id){
        $pregunta=Pregunta::find($id);
        $id_formulario=$pregunta->id_formulario;
        $pregunta->delete();


        return redirect('formularios/create'.'?id='.$id_formulario)->with('error','Pregunta eliminada.');

    }

    function GuardarNombreFormulario(Request $request,$id){
        if(!Formulario::find($id)){
            $formulario=new Formulario();
            $formulario->id_administrador = GetId(); 
            $formulario->id=$id;
            $formulario->save();
        }

        $formulario=Formulario::find($id);
        $formulario->formulario=$request->formulario;
        $formulario->save();
        return redirect('formularios/create'.'?id='.$id)->with('success','Se guardo el nombre.');
    }

    function UpdatePregunta(Request $request,$id){
        $pregunta=Pregunta::find($id);
        $pregunta->orden=$request->orden;
        $pregunta->pregunta=isset($request->texto) ? $request->texto : '';
        $pregunta->opciones=isset($request->opciones) ? $request->opciones : '';
        $pregunta->save();

        return Redirect::back()->with('success', 'Correcto.');
        
    }

    function EliminarFormulario($id){
        $formulario=Formulario::find($id);
        return view('administradores.formularios.destroy',['formulario'=>$formulario]);
    }

    function DestroyFormulario($id){
        $formulario=Formulario::find($id);
        
        $formulario->delete();



        return redirect('formularios')->with('error','Formulario eliminada.');

    }


    
    function Copy($id){
        $formulario=Formulario::find($id);
        return view('administradores.formularios.copy',['formulario'=>$formulario,'id'=>$id]);
    }


    function Copiar(Request $request,$id){
        
        $formulario=Formulario::find($id);

        $iden=GetUuid(); 
        $formulario=new Formulario();
        $formulario->id_administrador = GetId(); 
        $formulario->formulario=$request->formulario;
        $formulario->id=$iden;
        $formulario->save();
        

        $pres=Pregunta::where('id_formulario',$formulario->id)->get();

        foreach($pres as $pre){

            $pregunta=new Pregunta();
            $pregunta->id=GetUuid();
            $pregunta->id_formulario=$iden;
            $pregunta->tipo=$pre->tipo;
            $pregunta->pregunta=$pre->pregunta;
            $pregunta->opciones=$pre->opciones;
            $pregunta->orden=$pre->orden;
            $pregunta->save();
        }

        return redirect('formularios')->with('success','Formulario copiada.');


    }

    
}
