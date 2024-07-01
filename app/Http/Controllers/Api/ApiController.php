<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Medico;

use App\Models\Registro;

class ApiController extends Controller
{
    function GenerarPass(Request $request){
        $str = random_bytes(8);
        $str = base64_encode($str);
        $str = str_replace(["+", "/", "="], "", $str);
        $str = substr($str, 0, 8);
       

        if($medico = Medico::find($request->id)){
            $medico->pass = '';
            $medico->temp = $str;
            $medico->save();
            return array('status'=>1,$medico);
        }

      
        
        return array('status'=>0,array());
    }


    
}
