`<!DOCTYPE html>
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
                
                
              </div>
              <div class="card-body">
              <form action="{{url('geocercas')}}/{{$geocerca->id}}" method="POST" enctype="multipart/form-data">           
              @csrf     
              @method('put')
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <input required  type="text" class="form-control" id="nombre" name="nombre" placeholder="Lugar" value="{{$geocerca->nombre}}"> 
                  </div>
                </div>
              </div>  
              <div class="row">
                <div class="col-md-12">
                  <div id="map" style=" height: 350px; width:100%;"></div>
                </div>
              </div>  
              <br>             
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input required  type="text" class="form-control" id="lat" name="lat" placeholder="Lat" value="{{$geocerca->lat}}"> 
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input required  type="text" class="form-control" id="lon" name="lon" placeholder="Lon" value="{{$geocerca->lon}}"> 
                  </div>
                </div>
              </div>      

              <div class="row">
                <div class="col-md-12">
                <input required  type="text" class="form-control" id="rad" name="rad" placeholder="Lon" value=""> 
                </div>
              </div>
                  
              <br>
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-info">Actualizar</button>
                </div>
              </div>
                    
               
            </form>


                
              </div>

              <div class="card-footer">
              
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

    var xx=$('#lat').val();
    var yy=$('#lon').val();
    
    var markers = [];
    var marker;
    var geocoder;
    function initMap(zoom=15) {
        var initialLat = $('#lat').val()*1;
        var initialLong = $('#lon').val()*1;
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
          content: $('#nombre').val(),
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
            $('#lat').val(coordenadas.lat); 
            $('#lon').val(coordenadas.lng); 
            console.log('Lat: '+xx+' Lon: '+yy);
            $('#rad').val(Math.sqrt(Math.pow((coordenadas.lat-xx), 2) + Math.pow((coordenadas.lng-yy), 2)) );
            const coorobra = { lat:  coordenadas.lat*1, lng: coordenadas.lng*1 };
            marker = new google.maps.Marker({
                position: coorobra,
                map,
                title:$('#obra').val()
            });
             //Add marker to the array.
            markers.push(marker);
            infoWindow.setContent('le punto se localiza:<br>Latitud:'+coordenadas.lat+'<br>Longitud:'+coordenadas.lng);
          
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
                   

                    
                    $('#longitud').val(ui.item.lat);
                    $('#longitud').val(ui.item.lon);
                    //var latlng = new google.maps.LatLng(ui.item.lat, ui.item.lon);
                    //marker.setPosition(latlng);
                    
                    initMap(16);
                }
            });
        });
        
        
    });
</script>
@include('MapsApi')
</body>
</html>
`