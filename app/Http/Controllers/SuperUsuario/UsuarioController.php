<?php

namespace App\Http\Controllers\SuperUsuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Administrador;

class UsuarioController extends Controller
{
    function index(){
        $usuarios = Administrador::all();
        
        return view('superusuario.usuarios.index',['usuarios'=>$usuarios]);


    }

    
}
