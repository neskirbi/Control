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
              <div class="card card-danger">
                  <div class="card-header">
                      <h3 class="card-title"><i class="nav-icon fa fa-trash" aria-hidden="true"></i> Quitar Médico</h3> 
                                               
                  </div>     
                  <div class="card-body">
                    
                     
                      <div class="row">
                          <div class="col-sm-6">
                              <div class='form-group'>
                                  <label for="cliente">Cliente</label>
                                  <input disabled type="text" class="form-control" id="cliente" name="cliente" placeholder="Cliente" value="{{$cliente->cliente}}">
                              </div>
                          </div>
                         
                      </div>

                      
                      <div class="row">                 

                          <div class="col-md-3">
                          <a href="{{url('clientes')}}" class="btn btn-info btn-block"><i class="nav-icon fa fa-times" aria-hidden="true"></i> Cancelar</a>                     
                          </div>

                          <div class="col-md-3">
                            
                          </div>

                          <div class="col-md-3">
                            
                          </div>

                          <div class="col-md-3">
                            <form action="{{url('clientes')}}/{{$cliente->id}}" id="Nadmin" method="post">
                              @csrf
                              @method('delete')
                              <button class="btn btn-danger btn-block"><i class="nav-icon fa fa-times" aria-hidden="true"></i> Borrar</button>                     
                            </form>
                          </div>
                       
                          
                      </div> 
                      
                      
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
