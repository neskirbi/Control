<?php

namespace App\Http\Controllers\SuperUsuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\SuperUsuario;
use App\Models\Administrador;
use App\Models\Medico;

class LoginController extends Controller
{
    function LoginMD(Request $request){

        if( Auth::guard('superusuarios')->check()){
            Auth::guard('superusuarios')->logout();            
        }


        $adm = Administrador::where([
            'mail' => $request->mail
        ])->first();

        if($adm){            
            Auth::guard('administradores')->login($adm);
            return redirect('/');
        }
    }
}
