<!DOCTYPE html>
<html lang="en">
<head>
  @include('administradores.header')  
</head>
<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="{{count($posiciones)+1}}"><center><font size="6">{{$mes}}</font></center></th>
            </tr>           
            <tr>
                <th style="width:250px;"><center>Nombre</center></th>
                @foreach($posiciones as $posicion)
                <th><center>{{date('d',strtotime($posicion))}}</center></th>
                @endforeach
            </tr>
            
        </thead>
        <tbody>
            @foreach($asistencias as $asistencia)
                <tr>
                    <td><center>{{$asistencia->medico}}</center></td>
                
                    <?php $dias = explode(',',$asistencia->fecha);?>
                    @foreach($posiciones as $posicion)
                        @if(in_array(date('d',strtotime($posicion)),$dias))
                        <td><center>1</center></td>
                        @else
                        <td></td>
                        @endif
                    @endforeach
                </tr>
                
            @endforeach
            </tr>
        </tbody>
    </table>
</body>
</html>


