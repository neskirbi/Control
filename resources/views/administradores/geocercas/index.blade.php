<!DOCTYPE html>
<html lang="en">
<head>
  @include('administradores.header')
  <title>MED | Geocercas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('administradores.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('administradores.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        

        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header">
              <h3 class="card-title"> <i class="nav-icon fa fa-globe" aria-hidden="true"></i> Geocercas</h3>
                <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Opciones <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('geocercas')}}" method="GET">
                       
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-building"></i></span>
                          </div>
                          <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Lugar" @if(isset($filtros->nombre)) value="{{$filtros->nombre}}" @endif >
                        </div>

                        <div class="dropdown-divider"></div>
                        <a href="{{url('geocercas')}}" class="btn btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-info btn-sm float-right">Buscar</button>
                        
                        <div class="dropdown-divider"></div>
                        <a class="btn btn-success btn-block" href="{{url('geocercas')}}/create"><i class="fa fa-plus"></i> Agregar</a>
                      </form>
                      
                    </div>
                  </div>                
                </div>              

                
              </div>
              <div class="card-body">
              @if(count($geocercas))
                @foreach($geocercas as $geocerca)

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <h5 class="card-title" title="{{$geocerca->nombre}}"><b>{{strlen($geocerca->nombre)<81 ? $geocerca->nombre : mb_substr($geocerca->nombre,0,80,"UTF-8").'...'}}</b></h5>
                            

                              <br>
                              <!--<h5 class="card-title" title="{{$geocerca->nombre}}"><b>{{strlen($geocerca->nombre)<81 ? $geocerca->nombre : mb_substr($geocerca->nombre,0,80,"UTF-8").'...'}}</b></h5>-->
                             
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">                           
                            <br>
                            </div>
                          </div>
                          
                          
                          <div class="row">
                                                    
                            <div class="col-md-3" >
                              <a href="geocercas/{{$geocerca->id}}" class="btn btn-info btn-block" ><i class="fa fa-eye" aria-hidden="true"></i> Revisar</a>
                            </div>   

                            <div class="col-md-3" > 
                           
                            </div> 
                            <div class="col-md-3" >                       
                            </div>        

                            <div class="col-md-3" >
                             
                            </div>                          
                          
                          </div>

                          <hr>

                          <div class="row">

                          <div class="col-md-3" >
                              @if($geocerca->mailrepre!='' && $geocerca->contrato==0)
                              <small class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i> Contrato Ok</small>
                              @endif
                              
                            </div>  


                                                    
                            <div class="col-md-3" > 
                              
                            </div>   

                            <div class="col-md-3" >                            
                            </div> 

                            <div class="col-md-3" >    
                              @if($geocerca->mailrepre!='' && $geocerca->contrato==0)
                              <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="{{$geocerca->id}}" onclick="Marcar(this);" {{$geocerca->trabajando == 1 ? 'checked' : ''}} >
                                <label for="{{$geocerca->id}}" class="custom-control-label">Trabajándolo</label>
                              </div>  
                              @endif                 
                            </div>        

                                                    
                          
                          </div>
                          @if($geocerca->alerta!='')
                          
                          <?php
                          $alertas = explode(',',$geocerca->alerta);
                          ?>
                          
                          <div class="row">
                            <div class="col-md-12">
                              <hr>
                              @foreach($alertas as $alerta)
                              <small class="badge badge-danger"><i class="fa fa-check" aria-hidden="true"></i> {{$alerta}}</small>
                              @endforeach
                              <!--<p style="font-size:12px; color:#949494;">Cargar los documentos y guardar la nombre de nuevo.</p>-->
                              
                            </div>
                          </div>
                          @endif
                      </div>
                    </div>
                  </div>
                </div>

                @endforeach
              @endif


                
              </div>

              <div class="card-footer">
              {{ $geocercas->appends($_GET)->links('pagination::bootstrap-4') }}
              </div>
            </div>
            
            <!-- /.card -->
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
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);

 
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<script>
</script>

@include('administradores.geocercas.modals.nueva')

<script>

    var markers = [];
    var marker;
    var geocoder;
    function initMap(zoom=4) {
        var initialLat = $('#latitud').val()*1;
        var initialLong = $('#longitud').val()*1;
        initialLat = initialLat?initialLat:{{GetLatMexico()}};
        initialLong = initialLong?initialLong:{{GetLonMexico()}};

        const myLatlng = { lat:  initialLat, lng:  initialLong };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: zoom,
          center: myLatlng,
        });

        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            position: myLatlng
        });
        
        markers.push(marker);
        
        geocoder = new google.maps.Geocoder();
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
          content: "Seleccione ubicación de la obra",
          position: myLatlng,
        });

       
        infoWindow.open(map,marker);

        // Configure the click listener.
         
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            DeleteMarkers();
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
              position: mapsMouseEvent.latLng,
            });
            var coordenadas=mapsMouseEvent.latLng.toJSON();
            $('#latitud').val(coordenadas.lat);
            $('#longitud').val(coordenadas.lng);
            const coorobra = { lat:  coordenadas.lat*1, lng: coordenadas.lng*1 };
            marker = new google.maps.Marker({
                position: coorobra,
                map,
                title:$('#obra').val()
            });
             //Add marker to the array.
            markers.push(marker);
            infoWindow.setContent('La obra se localiza:<br>Latitud:'+coordenadas.lat+'<br>Longitud:'+coordenadas.lng);
          
            infoWindow.open(map,marker);
          
        });
    }

$(document).ready(function () {
    //load google map
        
        /*
         * autocomplete location search
         */
        var PostCodeid = '#search_location';
        $(function () {
            $(PostCodeid).autocomplete({
                source: function (request, response) {
                    geocoder.geocode({
                        'address': request.term
                    }, function (results, status) {
                        response($.map(results, function (item) {
                            //console.log(results);
                            return {
                                label: item.formatted_address,
                                value: item.formatted_address,
                                lat: item.geometry.location.lat(),
                                lon: item.geometry.location.lng()
                            };
                        }));
                    });
                },
                select: function (event, ui) {
                    var direccionarray=ui.item.value.split(',');
                    //console.log('Calle: '+direccionarray[0]);
                   

                    
                    $('#latitud').val(ui.item.lat);
                    $('#longitud').val(ui.item.lon);
                    //var latlng = new google.maps.LatLng(ui.item.lat, ui.item.lon);
                    //marker.setPosition(latlng);
                    
                    initMap(16);
                }
            });
        });
        
        
    });
</script>
</body>
</html>
