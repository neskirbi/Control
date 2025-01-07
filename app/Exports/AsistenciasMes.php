<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

use App\Models\Registro;
use App\Models\Medico;

class AsistenciasMes implements FromView
{

    private $year='';
    private $month='';

    public function  __construct($year,$month){
        $this->year = $year;
        $this->month = $month;
    }

    public function view(): View
    {

        $fecha = date(('Y-m'),strtotime($this->year.'-'.$this->month));
        $diasmes = DiasMeses();
        $posiciones = array();
        $meses = Meses();
        $mes = $meses[$this->month-1];
        //$tabla = array(array(),array());

        $asistencias = Medico::select('medicos.id',DB::RAW("concat(medicos.nombres,' ',medicos.apellidos) as medico")
            ,DB::RAW("group_concat(day(checkin)) fecha"))
            ->join('registros','registros.id_medico','=','medicos.id')
            ->whereraw("year(registros.checkin) = '$this->year' and month(registros.checkin) = '$this->month'")
            ->groupby('medicos.id','medico')
            ->orderby('medicos.nombres','asc')
            ->orderby('apellidos','asc')
            ->orderby('registros.checkin','asc')
            ->get();


        for($i=1;$i<=$diasmes[$this->month-1];$i++){
            $posiciones[]=date(('Y-m-d'),strtotime($this->year.'-'.$this->month.'-'.$i));
        }

        //return $posiciones;

        return view('reportes.asistenciasmes',['asistencias'=>$asistencias,'posiciones'=>$posiciones,'mes'=>$mes]);
        
    }
}
