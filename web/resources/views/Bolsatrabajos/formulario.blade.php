
<form action="{{ route('bolsatrabajos.store')}}" method="POST" enctype="multipart/form-data">
 @csrf

 <!-- Input de  Urgente -->
<div class="col-form-label col-sm-3 ">
<label class="badge badge-primary">Urgente ? </label><br>
<label class="form-check-label" for="urgente"> Si </label>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="urgente" id="Si" value="Sí" required>
 </div>
 <label class="form-check-label" for="urgente"> No </label>
 <div class="form-check form-check-inline">
     <input class="form-check-input" type="radio" name="urgente" id="No" value="No" required>
</div>
 </div>
 <!-- Input de Titulo -->
        <div class="form-group row">
          <label for="titulo" class="col-form-label col-sm-3">Titulo:</label>
          <div class="col-sm-8">
            <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Titulo" required>
          </div>
        </div>

        <!-- Input de Ubicacion -->
              <div class="form-group row">
                <label for="ubicacion" class="col-form-label col-sm-3">Ubicación:</label>
                <div class="col-sm-8">
                  <input type="text" name="ubicacion" id="ubicacion" class="form-control" placeholder="Ubicación" required >
                </div>
              </div>

        <!-- Input de Empresa -->
            <div class="form-group row">
              <label for="empresa" class="col-form-label col-sm-3">Empresa:</label>
              <div class="col-sm-8">
                <input type="text" name="empresa" id="empresa" class="form-control" placeholder="Empresa" required>
              </div>
            </div>

            <!-- Input de M -->
                 <div class="form-group row">
                   <label for="tipoPuesto" class="col-form-label  col-sm-3 ">Tipo de Puesto:</label>
                   <div class="col-sm-8">
                   <select id="tipoPuesto" class="form-control" name="tipoPuesto" required>
                       <option>Tiempo Completo</option>
                       <option>Tiempo Parcial</option>
                       <option>Contrato/Temporario</option>
                   </select>
                   </div>
                   @if ($errors->has('sede'))
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('sede') }}</strong>
                       </span>
                   @endif
               </div>
  <hr>
  <p class="h5">Detalles:</p>
               <!-- Input de costo por hora -->
                   <div class="form-group row">
                     <label for="salario" class="col-form-label col-sm-3">Salario Estimado:</label>
                     <div class="col-sm-8">
                       <input type="number" name="salario" id="salario" class="form-control"  min="1" max="10000" step="1" oninput="validity.valid||(value=)" placeholder="Salario" required>
                     </div>
                   </div>

                   <!-- Input de Direccion -->
                    <div class="form-group row">
                        <label for="direccion" class="col-form-label col-sm-3">Dirección:</label>
                        <div class="col-sm-8">
                        <textarea class="form-control" id="message-text" name="direccion" placeholder="Direccion"></textarea>
                          </div>
                    </div>
                    <!-- Input de Descripcion -->
                     <div class="form-group row">
                         <label for="descripcion" class="col-form-label col-sm-3">Descripción:</label>
                         <div class="col-sm-8">
                         <textarea class="form-control" id="message-text" name="descripcion" placeholder="Descripcion"></textarea>
                           </div>
                     </div>
                     <!-- Input de Habilidades -->
                      <div class="form-group row">
                          <label for="habilidades" class="col-form-label col-sm-3">Habilidades:</label>
                          <div class="col-sm-8">
                          <textarea class="form-control" id="message-text" name="habilidades" placeholder="Habilidades"></textarea>
                            </div>
                      </div>
                      <!-- Input de Fecha y Hora -->
                            <div class="form-group row">
                              <label for="fecha" class="col-form-label col-sm-3">Fecha:</label>
                              <div class="col-sm-8">
                                <input type="date" name="fecha" id="fecha" class="form-control" placeholder="00/00/0000" required >
                              </div>
                            </div>
                      <!-- Input de Beneficios-->
                       <div class="form-group row">
                           <label for="beneficio" class="col-form-label col-sm-3">Beneficios:</label>
                           <div class="col-sm-8">
                           <textarea class="form-control" id="message-text" name="beneficio" placeholder="Beneficios"></textarea>
                             </div>
                       </div>

                       <!-- Input de Imagen -->
                            <div class="form-group row">
                               <label for="addfoto" class="col-form-label col-sm-3">Agregar Fotos:</label>
                               <div class="col-sm-8">
                               <input type="file" name="imagen" id="imagen" class="form-control" placeholder="Add Foto" >
                               </div>
                           </div>
  <!-- Informacion de Contacto -->
  <hr>
  <p class="h5">Información de Contacto:</p>
  <!-- Input de Nombre del Contacto -->
         <div class="form-group row">
           <label for="nombreContacto" class="col-form-label col-sm-3">Nombre Contacto:</label>
           <div class="col-sm-8">
             <input type="text" name="nombreContacto" id="nombreContacto" class="form-control" placeholder="Nombre del Contacto">
           </div>
         </div>
  <!-- Input de Celular -->
  <div class="form-group row">
    <label for="Celular" class="col-form-label col-sm-3">Celular:</label>
    <div class="col-sm-8">
      <input type="text" name="celular" id="celular" class="form-control" placeholder="Celular" >
    </div>
  </div>
  <!-- Input de email -->
  <div class="form-group row">
    <label for="Email" class="col-form-label col-sm-3">Email:</label>
    <div class="col-sm-8">
      <input type="text" name="emailContacto" id="emailContacto" class="form-control" placeholder="Email">
    </div>
  </div>

  <!-- Modal Footer -->
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-success">Publicar</button>
  </div>
</form>
