<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cliente;
class ClienteController extends Controller
{
    public function __construct(){
        $this->middleware('adlog');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $clientes = Cliente::orderby('cliente')->get();
        return view('administradores.clientes.index',['clientes'=>$clientes]);
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
        $cliente = new Cliente();
        
        $cliente->id = GetUuid();
        $cliente->id_administrador = GetId();
        $cliente->cliente = $request->cliente;
        $cliente->telefono = $request->telefono;
        $cliente->mail = $request->mail;
        $cliente->save();
        return redirect('clientes')->with('success','Datos guardados');

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
        $cliente = Cliente::find($id);
        
        $cliente->cliente = $request->cliente;
        $cliente->telefono = $request->telefono;
        $cliente->mail = $request->mail;
        $cliente->save();
        return redirect('clientes')->with('success','Datos guardados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        
        $cliente->delete();
        return redirect('clientes')->with('error','Datos borrados.');
    }

    function BorrarCliente($id){
        $cliente = Cliente::find($id);
        return view('administradores.clientes.destroy',['cliente'=>$cliente]);
    }
}
