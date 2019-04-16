<!-- datalle de Evento -->
<div class="form-group row">
<div class="col-sm-8">

  <h4>{{isset($titulo)?$titulo:null}}</h4>
  <img src="{{isset($imagen)?$imagen:null}}"  class="pull-left img-responsive thumb margin10 img-thumbnail">
  <br>
  <label>Título del Evento: {{isset($titulo)?$titulo:null}}</label>
  <br>
  <label>Lugar: {{isset($lugar)?$lugar:null}}</label>
  <br>
  <label>Fecha: {{  date("d M Y", strtotime($fecha)) }}</label>
  <br>
  <label>Costo: {{isset($costo)?$costo:null}}</label>
  <br>
  <label>Facultad: {{isset($facultad_nomb)?$facultad_nomb:null}}</label>
  <br>
  <label>Descripción: {{isset($descripcion)?$descripcion:null}}</label>

  </div>

</div>
</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
</div>
