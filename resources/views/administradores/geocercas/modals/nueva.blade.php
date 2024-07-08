<!-- Modal -->
<div class="modal fade" id="nueva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <form action="{{url('geocercas')}}" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cargar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            @csrf     
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input required  type="text" class="form-control" id="nombre" name="nombre" placeholder="Lugar"> 
                </div>
              </div>
            </div>  
            <div class="row">
              <div class="col-md-12">
                <div id="map" style=" height: 350px; width:100%;"></div>
              </div>
            </div>               
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input required  type="text" class="form-control" id="lat" name="lat" placeholder="Lat"> 
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input required  type="text" class="form-control" id="lon" name="lon" placeholder="Lon"> 
                </div>
              </div>
            </div>      
           
            
        </div>
        <div class="modal-footer">
            <button style="" type="submite" class="confirmarclick btn btn-info" data-texto="¿Desea cargar este contrato?"><i class="fa fa-check" aria-hidden="true"><span> Cargar</span></i></button>
        </div>
    </form>
    </div>
  </div>
</div>

