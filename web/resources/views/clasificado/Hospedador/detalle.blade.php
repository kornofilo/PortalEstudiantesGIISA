

<div class="form-group row">
<div class="col-sm-8">

    <h4>{{isset($titulo)?$titulo:null}}</h4>
    <img style="height:200px; width: 200px; margin: 40px;" src="/imagenes/clasificado/alquilerhospedaje/{{isset($imagen)?$imagen:null}}"  class="card-img-top">
    <br>
    <label>Precio por mes: {{isset($precio)?$precio:null}}</label>
    <br>
    <label>Ubicación: {{isset($ubicacion)?$ubicacion:null}}</label>
    <br>
    <label>Descripción: {{isset($descripcion)?$descripcion:null}}</label>
    <hr>
    <h3>Detalles</h3>
    <br>
    <label>Estacionamiento: {{isset($estacionamiento)?$estacionamiento:null}}</label>
    <br>
    <label>Habitaciones: {{isset($habitaciones)?$habitaciones:null}}</label>
    <br>
    <label>Baños: {{isset($baños)?$baños:null}}</label>
    <br>
    <label>Amueblada: {{isset($amueblado)?$amueblado:null}}</label>
    <hr>
    <div class="col-sm-8">
    <p class="h5">Información de Contacto</p>
    <br>
      <label>Nombre del Contacto: {{isset($nombre)?$nombre:null}}</label>
      <br>
      <label>Celular: {{isset($celular)?$celular:null}}</label>
      <br>
      <label>Email: {{isset($email)?$email:null}}</label>
      <br>
      <form action="/OtroPerfil" method="get">
        {{csrf_field()}}
        <input type="hidden" name="code" value="{{$email}}">
        <input type="submit" class="btn-info" value="Ver perfil del anunciante">
      </form>
    </div>

    <hr>
    <div class="col-sm-8">
      <label>Código de Publicación: {{isset($codigoPost)?$codigoPost:null}}</label>
    </div>

</div>
</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-success" data-dismiss="modal">Cerrar</button>
</div>