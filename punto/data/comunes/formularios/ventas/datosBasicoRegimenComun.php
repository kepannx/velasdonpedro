<?php
$objHtm=new objetosHtml();
$consulta=new queryAjax();
?>    
        <!-- DATOS FACTURACIÓN PARA PUNTOS DE VENTA DE RÉGIMEN COMÚN -->
        <div class="col-md-12">
              <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label col-md-12">Identificación</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-hashtag"></i></div>
                      <input type="text" class="form-control" id="identificacionCliente" placeholder="cédula, nit, algo! " value="" data-error="Debes decirme la identificación del cliente " required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label col-md-12">A Cuál Régimen Pertenece?</label>
                    <div class="input-group col-md-12">
                      <select id="regimenCliente" class="form-control col-md-12" data-error="Necesito Que Me Digas El Régimen Al Que Pertenece" required >
                         <?php  echo $objHtm->selectTiposRegimenTributario()?>
                      </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>



              <div class="col-md-4">
                <div class="form-group">
                    <label>Cómo Se Llama El Cliente?</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-user"></i></div>
                      <input type="text" class="form-control" id="nombreCliente" placeholder="Preguntale Su Nombre" value="" data-error="Necesito Saber Cómo Se Llama El Cliente" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>


              
          </div>
  
      <div class="col-md-12">
        <div class="col-md-12">
            <div class="form-group">
                <label>Dame La Dirección Del Cliente</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-home"></i></div>
                  <div id="direccionBase">
                  <input type="text" class="form-control" id="direccion" placeholder="Cuál Es La Dirección Del Cliente" data-toggle="modal" data-target="#formatoDireccion"  value="" data-error="Necesito que me digas donde vive o ubicamos al cliente"  required readonly=""></div>
                </div>
                <div class="help-block with-errors"></div>
            </div>
         </div>


         


      </div>


      <div class="col-md-12">
          <div class="col-md-3">
            <div class="form-group">
                <label>Departamento</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="ti-location-pin"></i></div>
                  <select id="deptoCliente" class="form-control" required="" data-error="Debes decirme el departamento">
                      <?php echo $consulta->selectDepto() ?>
                  </select>
                </div>
                <div class="help-block with-errors"></div>
            </div>
         </div>


         <div class="col-md-3">
            <div class="form-group">
                <label>Ciudad</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="ti-location-pin"></i></div>
                  <select id="ciudadCliente" class="form-control" required="" data-error="Una Dirección Sin Ciudad No Ayuda">
                      <?php echo $consulta->selectCiudades() ?>
                  </select>
                </div>
                <div class="help-block with-errors"></div>
            </div>
         </div>
            <div class="col-md-3">
              <div class="form-group">
                  <label class="control-label col-md-12">Preguntale El Email</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="ti-email"></i></div>
                    <input type="email" class="form-control" id="emailCliente" placeholder="Genial si tienes su email" value="" >
                  </div>
                  <div class="help-block with-errors"></div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                  <label class="control-label col-md-12">Preguntale El Teléfono</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                    <input type="text" class="form-control" id="telefonosCliente" placeholder="Cuál El el Teléfono?" value="" >
                  </div>
                  <div class="help-block with-errors"></div>
              </div>
            </div>

      </div>