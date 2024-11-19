<!DOCTYPE html>
<html lang="en">
<head>
  @include('superusuario.header')
  <title>MED | Administradores</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('superusuario.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('superusuario.sidebars.sidebar')

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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fa fa-group" aria-hidden="true"></i> Administradores</h3>

                <div class="card-tools">
                  <!--
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('generadorasoc')}}" method="GET">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-building"></i></span>
                          </div>
                          <input type="text" class="form-control" name="generador" id="generador" placeholder="Generador" @if(isset($filtros->generador)) value="{{$filtros->generador}}" @endif >
                        </div>

                        <div class="dropdown-divider"></div>
                        <a href="generadorasoc" class="btn btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-info btn-sm float-right">Aplicar</button>
                        
                      </form>
                      
                    </div>
                  </div>                 
                -->
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">

              <div class="row">
                  <div class="col-md-12">
                  @if(count($usuarios))         
                    
                    <div class="callout callout-info">
                    <h5>Administradores</h5>
                    </div>
                   
                    @foreach($usuarios as $usuario)

                    <div class="row usuario" data-usuario="{{$usuario->nombres}} {{$usuario->apellidos}}" >
                      <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-12">
                                 
                                  <h5 class="card-title" title="{{$usuario->nombres}} {{$usuario->apellidos}}"><b>{{strlen($usuario->nombres.' '.$usuario->apellidos)<81 ? $usuario->nombres.' '.$usuario->apellidos : mb_substr($usuario->nombres.' '.$usuario->apellidos,0,80,"UTF-8").'...'}}</b></h5>
                                     
                                  <br>                             
                                  <h5 class="card-title" title="{{$usuario->mail}}"><b>Mail:</b>{{$usuario->mail}}</h5>
                                  <br>                             
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">                           
                                <br>
                                </div>
                              </div>
                              
                              
                              <div class="row">
                                                        
                                <div class="col-md-3" >
                                  
                                </div>   

                                <div class="col-md-3" > 
                              
                                </div> 
                                <div class="col-md-3" >
                                 
                                </div>        

                                <div class="col-md-3" >  
                                  <form action="{{url('LoginMD')}}" method="post">
                                    @csrf
                                    <input type="text" name="mail" value="{{$usuario->mail}}" style="display:none;">
                                    <button class="btn btn-success btn-block">Iniciar sesión</button>
                                  </form>
                                          
                                </div>
                              
                              
                              </div>
                              
                              <div class="row">
                                <div class="col-md-12">
                                  <hr>
                                 
                                </div>
                              </div>
                              
                          </div>
                        </div>
                      </div>
                    </div>



                          
                   
                    @endforeach
                  
                  @endif
                  </div>
                </div>
                


              
                
              </div>
              <div class="card-footer">
             
              </div>
              <!-- /.card-body -->
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
</body>
</html>
