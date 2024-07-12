<!DOCTYPE html>
<html lang="en">
<head>
  @include('medicos.header')
  <title>MED | Checkin</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('medicos.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('medicos.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"> Checkin </h5>
                <div class="card-tools">
         
                
                </div>
              </div>

              <div class="card-body">

                <div class="row">
                  <div class="col-md-12">
                    <div id="map" style=" height: 350px; width:100%;"></div>
                  </div>
                </div>  

                <br>
                <div class="row" id="checkin" style="display:none;">
                  
                  <div class="col-md-12"> 
                    @if($registro->in==0 && $registro->out==0)
                    <form action="checkin" method="post">
                      @csrf
                      <button class="btn btn-success btn-block">Check-in</button>
                      <div class="row" style="display:none;">
                        <input data-invalido="true" type="text" name="lat" class="form-control" aria-invalid="false" placeholder="Latitud" id="latitud">
                        <input data-invalido="true" type="text" name="lon" class="form-control" aria-invalid="false" placeholder="Longitud" id="longitud">
                      </div>
                    </form>
                                      
                    @elseif($registro->in==1 && $registro->out==0)
                    <form action="checkout" method="post">
                      @csrf
                      <button class="btn btn-danger btn-block">Check-out</button>
                      <div class="row" style="display:none;">
                        <input data-invalido="true" type="text" name="lat" class="form-control" aria-invalid="false" placeholder="Latitud" id="latitud">
                        <input data-invalido="true" type="text" name="lon" class="form-control" aria-invalid="false" placeholder="Longitud" id="longitud">
                      </div>
                    </form>
                    @else
                    <div class="alert alert-success alert-dismissible" id="ucorrecto" style="">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Correcto!</h5>
                        El registro de hoy ya se realizó correctamente.
                    </div>
                    @endif
                  </div>
                </div> 
                
                <br>
               
                
                <form action="GuardarEncuesta" method="post">
                      @csrf
                      <?php $edit=0;?>
                      @include('administradores.viewsgenerales.inspecciones.preguntasshow')

                      <div class="row">

                        <div class="col-md-12">

                            <div class="form-group">
                               @if($preguntas)
                                <button class="btn btn-info btn-block">Guardar</button>

                                @endif
                            </div>

                        </div>

                      </div>



                </form>

                 
                <br>

                <div class="alert alert-danger alert-dismissible" id="uerror" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Error!</h5>
                    No se puede obtener ubicación.
                </div>

                <div class="alert alert-success alert-dismissible" id="ucorrecto" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Correcto!</h5>
                    Ubicado.
                </div>

                


            </div>
            
          </div>
          

        </div>
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);

 
</script>


<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>


<script>
    
    
    function funcionInit(){
        if (!"geolocation" in navigator) {
            return alert("Tu navegador no soporta el acceso a la ubicación. Intenta con otro");
        }

        const onUbicacionConcedida = ubicacion => {
            $("#latitud").val(ubicacion.coords.latitude);
            $("#longitud").val(ubicacion.coords.longitude);                                            
            $('#uerror').hide();
            initMapa(ubicacion.coords.latitude,ubicacion.coords.longitude)
            //$('#ucorrecto').show();           
            $('#checkin').show();
        }
    
        const onErrorDeUbicacion = err => {
            console.log("Error obteniendo ubicación: ", err);                                            
            $('#ucorrecto').hide();
            $('#uerror').show();
        }

        const opcionesDeSolicitud = {
            enableHighAccuracy: true, // Alta precisión
            maximumAge: 0, // No queremos caché
            timeout: 5000 // Esperar solo 5 segundos
        };
        // Solicitar
        navigator.geolocation.getCurrentPosition(onUbicacionConcedida, onErrorDeUbicacion, opcionesDeSolicitud);

    }


    funcionInit();
        
</script> 

<script>
  

    var markers = HtmltoJson('{{$marcadores}}');
    function initMapa(lat,lon) {
      //console.log(markers);
      var myLatlng = { lat:  parseFloat(lat), lng: parseFloat(lon) };
      var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 17,
        center: myLatlng,
      });


      imagenmed = {
            url: '{{asset("images/iconos/maps/med.png")}}',
            // Este marcador tiene 20 pixeless de ancho por 32 pixeles de alto.
            scaledSize: new google.maps.Size(35, 50),
            // El origen para esta imagen es (0, 0).
            origin: new google.maps.Point(0, 0),
            // El ancla para esa imagen es la base del asta bandera en (0, 32).
            anchor: new google.maps.Point(0, 32)
        };

     
      var marker = new google.maps.Marker({
          position: myLatlng,
          title: 'Yo',
          icon: imagenmed
      });
      
      
      marker.setMap(map);

      
      for(var i=0;i< markers.length ; i++){

        
        var  myLatlng = { lat:  parseFloat(markers[i].lat), lng: parseFloat(markers[i].lon) };
        var image = {
          url: '{{asset("images/iconos/maps/hospital.png")}}',
          // Este marcador tiene 20 pixeless de ancho por 32 pixeles de alto.
          scaledSize: new google.maps.Size(80, 90),
          // El origen para esta imagen es (0, 0).
          origin: new google.maps.Point(0, 0),
          // El ancla para esa imagen es la base del asta bandera en (0, 32).
          anchor: new google.maps.Point(0, 32)
        };
        var marker = new google.maps.Marker({
            position: myLatlng,
            title: markers[i].obra,
            icon: image
        });

         // Create the initial InfoWindow.
        /*let infoWindow = new google.maps.InfoWindow({
          content:markers[i].obra,
          position: myLatlng,
        });
        
        infoWindow.open(map,marker);*/

        // To add the marker to the map, call setMap();

     
        marker.setMap(map);
      }
      
    }
      
    </script>
@include('MapsApi')
</body>
</html>
