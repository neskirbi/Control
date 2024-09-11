<?php


use App\Models\SuperUsuario;
use App\Models\Administrador;
use App\Models\Cliente;
use App\Models\Medico;

function Memoria(){
    set_time_limit(0);
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 0); 
    ini_set('post_max_size', '30G');
}

function Version(){
    return 11;
}

function GetUuid(){
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
    return str_replace("-","",vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4)));
}


function ValidarMail($mail){
    
    if(SuperUsuario::where('mail',$mail)->first()){
        return true;
    }

    if(Administrador::where('mail',$mail)->first()){
        return true;
    }

    if(Cliente::where('mail',$mail)->first()){
        return true;
    }

    if(Medico::where('mail',$mail)->first()){
        return true;
    }

    
    return false;
}


function GetId(){
    $id='';

    if(Auth::guard('superusuarios')->check()){
        return Auth::guard('superusuarios')->user()->id;
    }

    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->id;
    }

    if(Auth::guard('medicos')->check()){
        return Auth::guard('medicos')->user()->id;
    }
}


function GetDateTimeNow(){
    return date('Y-m-d H:i:s');
}

function FechaFormateada($fecha){
       
    $dias=['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $anio=date('Y',strtotime($fecha));
    $mes=$meses[date('m',strtotime($fecha))-1];
    $dia=date('d',strtotime($fecha));
    $diasemana=$dias[date('w',strtotime($fecha))];
    
    return $diasemana.' '.$dia.' '.$mes.' '.$anio;
}

function FechaFormateadaTiempo($fecha){
       
    $dias=['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $anio=date('Y',strtotime($fecha));
    $mes=$meses[date('m',strtotime($fecha))-1];
    $dia=date('d',strtotime($fecha));
    $diasemana=$dias[date('w',strtotime($fecha))];
    
    return $diasemana.' '.$dia.' '.$mes.' '.$anio.' '.date('H:i',strtotime($fecha));
}

function TiempoFormateado($fecha){
       
    
    
    return date('H:i:s',strtotime($fecha));
}

function GetLatMexico(){
    return 20.248882446801847;
}


function GetLonMexico(){
    return -101.45472227050904;
}


?>