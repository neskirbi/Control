<!DOCTYPE html>
<html lang="en">
<head>
  @include('administradores.header')
  <title>Control | Periodos</title>

  
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

      <div class="callout callout-info">
      <h5><i class="fa fa-user" aria-hidden="true"></i> {{$medico->nombres}} {{$medico->apellidos}}</h5>
      </div>
        

      @foreach($periodos as $periodo)
      <div class="row">
        <div class="col-12">
          <div class="card">

            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Período</h3> 
              <div class="card-tools">
                <form action="{{url('EliminarPeriodo')}}/{{$periodo->id}}" method="post">
                  @csrf
                  <button class="btn btn-sm btn-default"> <i class="nav-icon fa fa-times" aria-hidden="true"></i> </button>
                </form>
              </div>
                                          
            </div>     
            <div class="card-body">
              <form action="{{url('NuevoPeriodo')}}/{{$medico->id}}" method="post">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="fini">Fecha Inicio</label>
                    <input required type="date" class="form-control" id="fini" name="fini" value="{{$periodo->fini}}">
                  </div>
                </div>
                
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="ffin">Fecha Fin</label>
                    <input required type="date" class="form-control" id="ffin" name="ffin" value="{{$periodo->ffin}}">
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
              <h3 class="card-title"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Agregar Período</h3> 
                                          
            </div>     
            <div class="card-body">
              <form action="{{url('NuevoPeriodo')}}/{{$medico->id}}" method="post">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="fini">Fecha Inicio</label>
                    <input required type="date" class="form-control" id="fini" name="fini">
                  </div>
                </div>
                
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="ffin">Fecha Fin</label>
                    <input required type="date" class="form-control" id="ffin" name="ffin">
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
                  <button class="btn btn-info btn-block"><i class="nav-icon fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>                     
                </div>
              </div> 
                
                
              </form>
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
@include('administradores.footer')
</body>
</html>
