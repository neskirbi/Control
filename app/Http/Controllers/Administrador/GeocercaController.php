<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Geocerca;

class GeocercaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $geocercas = Geocerca::where('id_administrador',GetId())->paginate(20);
        return view('administradores.geocercas.index',['geocercas'=>$geocercas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administradores.geocercas.create',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $geocerca = new Geocerca();
        $geocerca->id=Getuuid();
        $geocerca->id_administrador=GetId();
        $geocerca->nombre = $request->nombre;
        $geocerca->lat = $request->lat;
        $geocerca->lon = $request->lon;
        
        $geocerca->save();
        return redirect('geocercas')->with('geocercas','Datos Guardados.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $geocerca = Geocerca::find($id);
        return view('administradores.geocercas.show',['geocerca'=>$geocerca]);
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
        $geocerca = Geocerca::find($id);
        
        
        $geocerca->nombre = $request->nombre;
        $geocerca->lat = $request->lat;
        $geocerca->lon = $request->lon;
        
        $geocerca->save();
        return redirect('geocercas/'.$geocerca->id)->with('geocercas','Datos Guardados.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
