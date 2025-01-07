<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Registro;
use App\Models\Medico;

use App\Exports\AsistenciasMes;

class ReporteController extends Controller
{
    function AsistenciasMes($year,$month){
       
        return Excel::download(new AsistenciasMes($year,$month), 'AsistenciasMes'.'.xlsx');

        $fecha = date(('Y-m'),strtotime($year.'-'.$month));
        $diasmes = DiasMeses();
        $posiciones = array();
        $meses = Meses();
        $mes = $meses[$month-1];
        //$tabla = array(array(),array());

        $asistencias = Medico::select('medicos.id',DB::RAW("concat(medicos.nombres,' ',medicos.apellidos) as medico")
            ,DB::RAW("group_concat(day(checkin)) fecha"))
            ->join('registros','registros.id_medico','=','medicos.id')
            ->whereraw("year(registros.checkin) = '$year' and month(registros.checkin) = '$month'")
            ->groupby('medicos.id','medico')
            ->orderby('medicos.nombres','asc')
            ->orderby('apellidos','asc')
            ->orderby('registros.checkin','asc')
            ->get();


        for($i=1;$i<=$diasmes[$month-1];$i++){
            $posiciones[]=date(('Y-m-d'),strtotime($year.'-'.$month.'-'.$i));
        }

        //return $posiciones;

        return view('reportes.asistenciasmes',['asistencias'=>$asistencias,'posiciones'=>$posiciones,'mes'=>$mes]);

        
    }
}
