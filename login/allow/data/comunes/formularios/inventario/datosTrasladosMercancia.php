        <!-- DATOS PARA ENVIO DE MERCANCIA A UN PUNTO DE VENTA -->
        <div class="col-md-12" id="noPrint">
              <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-12">Punto de Venta de DESTINO</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-flag"></i></div>
                      <select id="origenId" name="origenId" class="form-control">
                        <option value="">Selecciona el Punto de destino</option>
                        <?php $consultasAjax->loadSelectPuntosVentas()?>
                      </select>
                    </div>
                </div>
              </div>


              <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-12">Punto de Venta de DESTINO</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-flag"></i></div>
                      <select id="destinoId" name="destinoId" class="form-control">
                        <option value="">Selecciona el Punto de destino</option>
                        <?php $consultasAjax->loadSelectPuntosVentas()?>
                      </select>
                    </div>
                </div>
              </div>
          <input type="hidden" id="changeOrigen">
          
          </div>


              
