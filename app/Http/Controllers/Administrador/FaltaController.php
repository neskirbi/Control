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
        $this->PonerFaltas();
        $faltas = Falta::join('medicos','medicos.id','faltas.id_medico')->whereraw("date(faltas.created_at) = date(now())")->paginate(20);
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


    function PonerFaltas(){
        
        $faltas = DB::select("select id,nombres from medicos where id not in (select id_medico from registros where date(checkin)=date(now()) ) and id_administrador='".GetId()."' and time(now()) > entrada ");
        
        foreach($faltas as $falta){
            //Si no hay periodo, no pone falta. Si hay periodo tiene que poner falta.
            if(Periodo::whereraw("id_medico='".$falta->id."' and date(now()) >= date(fini) and date(now()) <= date(ffin) ")->count()==0){
                return 'no hay periodo';
            }
            
            if(!Falta::where('id_medico',$falta->id)->whereraw('date(created_at)= date(now())')->first()){
                //return Periodo::whereraw("id_medico='".$falta->id."' and date(now()) >= date(fini) and date(now()) <= date(ffin) ")->get();
                $f = new Falta();
                $f->id = GetUuid();
                $f->id_medico = $falta->id;
                $f->save();
            }
            
        }
    }
}
