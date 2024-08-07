<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Geocerca;

use App\Models\Registro;

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

        $registros = Registro::select('medicos.nombres','medicos.apellidos','registros.tarde',DB::RAW("time(registros.checkin) as checkin"),
        DB::RAW("time(registros.checkout) as checkout"),'registros.latin','registros.lonin','geocercas.nombre')
        ->join('geocercas','geocercas.id','registros.id_geocerca')
        ->join('medicos','medicos.id','registros.id_medico')
        ->whereraw("date(registros.checkin) = '".$fecha."'")
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

   
}
