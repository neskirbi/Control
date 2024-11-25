<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Falta;
use App\Models\Periodo;

class FaltaController extends Controller
{
    public function __construct(){
        
        $this->middleware('adlog');
    }


    public function index(Request $filtros)
    {

        $fecha = isset($filtros->fecha) ? $filtros->fecha : date('Y-m-d');
        $this->PonerFaltas($fecha);
        $faltas = Falta::join('medicos','medicos.id','faltas.id_medico')
        ->whereraw("date(faltas.created_at) = date('$fecha')")->paginate(20);
        return view('administradores.faltas.index',['faltas'=>$faltas,'filtros'=>$filtros]);
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


    function PonerFaltas($fecha){
        
        $faltas = DB::select("select id,nombres from medicos where id not in (select id_medico from registros where date(checkin)=date('$fecha') ) and id_administrador='".GetId()."'  ");
        
        foreach($faltas as $falta){
            //Si no hay periodo, no pone falta. Si hay periodo tiene que poner falta.
            if(Periodo::whereraw("id_medico='".$falta->id."' and ('$fecha') >= date(fini) and ('$fecha') <= date(ffin) ")->count()==0){
                //return 'no hay periodo'.$fecha;
            }else{
                //return Falta::where("id_medico",$falta->id)->whereraw("date(created_at) = date('$fecha')")->first()
                if(!Falta::where("id_medico",$falta->id)->whereraw("date(created_at) = date('$fecha')")->first()){
                    //return'creando:'.$falta->id.' '.$fecha;
                    //return Periodo::whereraw("id_medico='".$falta->id."' and date(now()) >= date(fini) and date(now()) <= date(ffin) ")->get();
                    $f = new Falta();
                    $f->id = GetUuid();
                    $f->id_medico = $falta->id;
                    $f->created_at = $fecha;
                    $f->save();
                }

            }
            
           
            
        }
    }
}
