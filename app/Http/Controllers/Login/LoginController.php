<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\SuperUsuario;
use App\Models\Administrador;
use App\Models\Medico;

class LoginController extends Controller
{
    function index(){
        return view('login.index');
    }

    function Ingresar(Request $request){

        $su = SuperUsuario::where([
            'mail' => $request->mail
        ])->first();

        if($su){
            if($request->pass!=$su->pass){
                return redirect('login')->with('error', '¡Error de contraseña!');
            }
            Auth::guard('superusuarios')->login($su);
            return redirect('/');
        }


        $adm = Administrador::where([
            'mail' => $request->mail
        ])->first();

        if($adm){
            if($adm->temp!='' ){
                if($adm->temp==$request->pass){
                    return redirect(('newpass/'.$adm->id));
                }else{
                    return redirect('login')->with('error','Contraseña erronea.');
                }
                
            }
            if(!password_verify($request->pass,$adm->pass)){
                return redirect('login')->with('error', '¡Error de contraseña!');
            }
            Auth::guard('administradores')->login($adm);
            return redirect('/');
        }

        $medico = Medico::where([
            'mail' => $request->mail
        ])->first();

        if($medico){
            if($medico->temp!='' ){
                if($medico->temp==$request->pass){
                    return redirect(('newpass/'.$medico->id));
                }else{
                    return redirect('login')->with('error','Contraseña erronea.');
                }
                
            }
            if(!password_verify($request->pass,$medico->pass)){
                return redirect('login')->with('error', '¡Error de contraseña!');
            }
            Auth::guard('medicos')->login($medico);
            return redirect('/');
        }


        
        

        return redirect('login')->with('error', '¡Correo no registrado!');
    }

    function Logout(){
        if( Auth::guard('superusuarios')->check()){
            Auth::guard('superusuarios')->logout();
            return redirect('https://iotech-tecnology.com.mx/');
        }

        if( Auth::guard('administradores')->check()){
            Auth::guard('administradores')->logout();
            return redirect('https://iotech-tecnology.com.mx/');
        }

        if( Auth::guard('medicos')->check()){
            Auth::guard('medicos')->logout();
            return redirect('https://iotech-tecnology.com.mx/');
        }
    }

    function NewPass($id){
        if($usuario = Administrador::find($id)){
            return view('login.newpass',['usuario'=>$usuario]);
        }

        if($usuario = Medico::find($id)){
            return view('login.newpass',['usuario'=>$usuario]);
        }
    }

    function SavePass(Request $request,$id){
        if($request->pass!=$request->pass2){
            return redirect('login')->with('error', '¡Error de contraseñas, no coinciden!');
        }

        
        
        if($adm = Administrador::find($id)){            
            $adm->pass = password_hash($request->pass, PASSWORD_DEFAULT);
            $adm->temp = '';
            $adm->save();
         
            
            Auth::guard('administradores')->login($adm);

            return redirect('/');
        }


        if($medico = Medico::find($id)){            
            $medico->pass = password_hash($request->pass, PASSWORD_DEFAULT);
            $medico->temp = '';
            $medico->save();
         
            
            Auth::guard('medicos')->login($medico);

            return redirect('/');
        }

        return redirect('login')->with('error', '¡No se pudo iniciar sesión!');
        
    }
}
