<?php

namespace App\Http\Controllers\Medico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Registro;
class CheckinController extends Controller
{

    public function __construct(){
        $this->middleware('mdlog');
    }


    function index(){
        $registro = Registro::where('id_medico',GetId())->whereraw("date(created_at) = date(now())")->first();
        if(!$registro){
            $registro = new Registro();
        }
        return view('medicos.checkin.index',['registro'=>$registro]);
    }

    function Checkin(Request $request){
        if(!Registro::where('id_medico',GetId())->whereraw("date(created_at) = date(now())")->first()){
            $registro = new Registro();
            $registro->id = GetUuid();
            $registro->id_medico=GetId();
            $registro->checkin = date('Y-m-d H:i:s');
            $registro->checkout = date('Y-m-d H:i:s');
            $registro->in = '1';
            $registro->save();
            return redirect('check')->with('success','Se realizó correctamente el checkin.');
        }else{
            return redirect('check')->with('error','El checkin ya se habia realizado.');
        }
       

        

    }

    function Checkout(Request $request){
        $registro =  Registro::where('id_medico',GetId())->whereraw("date(created_at) = date(now())")->first();       
        if($registro){
            $registro->out = '1';
            $registro->save();

            return redirect('check')->with('success','Se realizó correctamente el checkout.');
        }else{
            return redirect('check')->with('error','No se ha hecho checkin.');
        }
        
    }
}
