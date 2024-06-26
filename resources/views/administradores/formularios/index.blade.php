<!DOCTYPE html>

<html lang="en">

<head>

  @include('administradores.header')

  <title>Encuestas</title>



  

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

                <h3 class="card-title">Formulario</h3>



                

                

              </div>

              <!-- /.card-header -->

              <div class="card-body">



                <div class="row">

                  <div class="col-md-12">

                    <a href="{{url('formularios\create')}}" class="btn btn-info"> <i class="fas fa-plus"></i> Formulario </a>

                  </div>

                </div>





                <div class="row">

                  <div class="col-md-12" style="overflow-x:scroll;">

                    @if(count($formularios))

                    <table class="table table-hover text-nowrap">

                      <thead>

                        <tr>

                          <th>Formulario</th> 

                          <th>Opciones</th>
                          <th></th>
                          
                          <th></th>

                        </tr>

                      </thead>

                      <tbody>

                    

                        @foreach($formularios as $formulario)

                        <tr>

                          <td title="{{$formulario->formulario}}">{{($formulario->formulario)}}</td>

                          

                          <td>
                            <a href="formularios/create?id={{$formulario->id}}" class="btn btn-info" ><i class="fa fa-eye" aria-hidden="true"></i> Revisar</a>

                          </td>

                          <td>
                            <a href="formularios/Copy/{{$formulario->id}}" class="btn btn-warning" ><i class="fa fa-print" aria-hidden="true"></i> Copiar</a>

                          </td>

                          <td>
                            <a href="{{url('EliminarFormulario')}}/{{$formulario->id}}" class="btn btn-danger" ><i class="fa fa-times" aria-hidden="true"></i> Eliminar</a>

                          </td>

                          

                        </tr>

                        @endforeach

                        

                      </tbody>

                    </table>

                    @endif

                  </div>

                </div>

                

                

              </div>

              <!-- /.card-body -->

              <div class="card-footer">

              {{ $formularios->appends($_GET)->links('pagination::bootstrap-4') }}

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

