<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Registro;
use App\Models\Medico;

class ReporteController extends Controller
{
    function index(){
        return view('administradores.reportes.index');
    }

    function Asistencias(Request $request){
        $year = isset($request->year) ? $request->year : date('Y');
        $asistencias = Medico::select(DB::raw('YEAR(registros.created_at) year, MONTH(registros.created_at) month'), DB::raw('count(registros.id) as asistencia'))
        ->join('registros','registros.id_medico','=','medicos.id')
        ->whereraw('YEAR(registros.created_at) = \''.$year.'\'')
        ->where('medicos.id_administrador',Getid())
        ->groupby('year','month')
        ->get();
        return view('administradores.reportes.frames.asistencias',[
        'year'=>$year,
        'filtros'=>$request,'asistencias'=>$asistencias]);
    }
}
