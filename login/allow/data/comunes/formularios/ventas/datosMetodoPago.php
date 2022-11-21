        <!-- DATOS FACTURACIÓN PARA PUNTOS DE VENTA DE RÉGIMEN SIMPLIFICADO -->
        <div class="col-md-12" id="noPrint">
              <div class="col-md-6" >
                <div class="form-group">
                    <label class="control-label col-md-12">Fecha de la Factura</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="fechaFactura" placeholder="<?php echo date('Y/m/d'); ?> " value="<?php echo date('Y/m/d'); ?>"  >
                      <span class="input-group-addon"><i class="icon-calender"></i></span> 
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>


              <div class="col-md-6">
                <div class="form-group">
                    <label>Quién Lo Vendió?</label>
                    <div class="input-group col-md-12">
                      <select  id ="codigoVendedor" class="form-control col-md-12">
                        <?php
                            $consultasAjax->selectVendedores();
                        ?>
                      </select>
                    </div>
                </div>
              </div>
              



              
          </div>