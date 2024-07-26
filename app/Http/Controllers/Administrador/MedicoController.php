<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Periodo;
use Redirect;

class MedicoController extends Controller
{

    public function __construct(){
        $this->middleware('adlog');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medicos = Medico::where('id_administrador',GetId())->paginate(15);
        return view('administradores.medicos.index',['medicos'=>$medicos]);
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
        if(ValidarMail($request->mail)){
            return redirect('medicos')->with('error','Ingresar un correo diferente, con el que intentó ya está registrado.');
        }
        $medico = new Medico();
        $medico->id = GetUuid();
        $medico->id_administrador=GetId();
        $medico->nombres = $request->nombres;
        $medico->apellidos = $request->apellidos;
        $medico->entrada = $request->entrada;
        $medico->salida = $request->salida;
        $medico->telefono = $request->telefono;
        $medico->mail = $request->mail;        
        $medico->pass = '';
        $medico->token = '';   
        $medico->save();
        return redirect('medicos')->with('success','Datos Guardados.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medico = Medico::find($id);
        $periodos = Periodo::where('id_medico',$id)->orderby('fini','desc')->get();

        return view('administradores.medicos.show',['medico'=>$medico,'periodos'=>$periodos]);
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
        if(ValidarMail($request->mail)){
            return redirect('medicos')->with('error','Ingresar un correo diferente, con el que intentó ya está registrado.');
        }
        $medico = Medico::find($id);
        
        $medico->nombres = $request->nombres;
        $medico->apellidos = $request->apellidos;
        $medico->entrada = $request->entrada;
        $medico->salida = $request->salida;
        $medico->telefono = $request->telefono;
        
        if(isset($request->mail))
        $medico->mail = $request->mail;
        
        $medico->save();
        return redirect('medicos')->with('success','Datos Guardados.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medico = Medico::find($id);
        $medico->delete();
        return redirect('medicos')->with('error','Registro Borrado.');
    }


    function BorrarMedico($id){        

        $medico = Medico::find($id);

        return view('administradores.medicos.destroy',['medico'=>$medico]);
    }


    function NuevoPeriodo(Request $request,$id){
        $periodo = new Periodo();
        $periodo->id = GetUuid();
        $periodo->id_medico = $id;
        $periodo->fini = $request->fini;
        $periodo->ffin = $request->ffin;
        $periodo->save();
        return redirect('medicos/'.$id)->with('success','Período agregado.');
    }


    function EliminarPeriodo($id){
        $periodo = Periodo::find($id);
        $periodo->delete();
        return Redirect::back()->with('danger','Período borrado.');
    }

    
}
