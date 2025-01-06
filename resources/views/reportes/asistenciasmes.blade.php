<table border="1">
    <thead>
        <th style="width:50px;">Nombre</th>
        @foreach($posiciones as $posicion)
        <th style="width:50px;">{{date('d',strtotime($posicion))}}</th>
        @endforeach
    </thead>
    <tbody>
        <?php $medico=''?>
        @foreach($asistencias as $asistencia)
            <tr>
                <td>{{$asistencia->medico}}</td>
            
                <?php $dias = explode(',',$asistencia->fecha);?>
                @foreach($posiciones as $posicion)
                    @if(in_array(date('d',strtotime($posicion)),$dias))
                    <td>1</td>
                    @else
                    <td></td>
                    @endif
                @endforeach
            </tr>
            
        @endforeach
        </tr>
    </tbody>
</table>