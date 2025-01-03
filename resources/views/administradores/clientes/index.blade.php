<!DOCTYPE html>
<html lang="en">
<head>
  @include('administradores.header')
  <title>Control | Clientes</title>

  
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
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fa fa-group" aria-hidden="true"></i> Clientes</h3>

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

              @foreach($clientes as $cliente)

              <div class="row">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title"><i class="nav-icon fa fa-user" aria-hidden="true"></i> Clientes</h3> 
                            <div class="card-tools">
                                <div class="btn-group dropleft">
                                    <button class="btn btn-default " type="button" id="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="menu">
                                        <a class="dropdown-item" href="{{url('BorrarCliente').'/'.$cliente->id}}"><i class="fa fa-trash" aria-hidden="true"></i> Borrar</a>
                                    </div>
                                </div>
                            </div>                           
                        </div>     
                        <div class="card-body">
                          <form action="{{url('clientes')}}/{{$cliente->id}}" id="Nadmin" method="post">
                            @csrf                            
                            @method('put')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class='form-group'>
                                        <label for="nombre">Cliente</label>
                                        <input required type="text" class="form-control" id="cliente" name="cliente" placeholder="Cliente" value="{{$cliente->cliente}}">
                                    </div>
                                </div>
                               
                            </div>
                            


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class='form-group'>
                                        <label for="telefono">Teléfono</label>
                                        <input required type="tel" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" value="{{$cliente->telefono}}">
                                    </div>
                                </div>
                              
                                      
                                                   
                               
                               <div class="col-sm-4">
                                   <div class='form-group'>
                                       <label for="mail">Correo</label>
                                       <input  data-valor="{{$cliente->mail}}" required type="mail" class="form-control" name="mail" id="mail" placeholder="Correo"  value="{{$cliente->mail}}">
                                   </div>
                               </div> 
                               
                               
                             
                               
                            </div>   
                            <div class="row">
                              <div class="col-md-3">
                                
                              </div>
                              <div class="col-md-3">
                                
                              </div>
                              <div class="col-md-3">
                                
                              </div>
                              <div class="col-md-3">
                                <button type="submit" class="btn btn-info btn-block"> <i class="nav-icon fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                              </div>
                            </div>                     
                          </form>
                        </div>
                             
                    </div>                    
                </div>
              </div>
                
              @endforeach

              <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Agregar Cliente</h3>                            
                        </div>                        
                        @csrf
                        <div class="card-body">
                          <form action="{{url('clientes')}}" id="Nadmin" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class='form-group'>
                                        <label for="cliente">Cliente</label>
                                        <input required type="text" class="form-control" id="cliente" name="cliente" placeholder="Cliente">
                                    </div>
                                </div>
                               
                            </div>

                            

                           

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class='form-group'>
                                        <label for="telefono">Teléfono</label>
                                        <input required type="tel" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" value="">
                                    </div>
                                </div>
                              
                                                 
                               
                               <div class="col-sm-4">
                                   <div class='form-group'>
                                       <label for="mail">Correo</label>
                                       <input required type="mail" class="form-control" id="mail" name="mail" placeholder="Correo">
                                   </div>
                               </div>  
                             
                               
                            </div>   
                            <button type="submit" class="btn btn-info float-right">Guardar</button>                     
                          </form>
                        </div>
                             
                    </div>                    
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
