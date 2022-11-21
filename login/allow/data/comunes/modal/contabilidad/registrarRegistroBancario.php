<div id="registrarRegistroBancario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" align="center"> <i class="fa fa-warning"></i> Estas Por Hacer un Registro Bancario</h4>
                  </div>
                  <div class="modal-body">
                    <form name="egreso">
                    <!-- Inicio de formulario-->
                    <div class="col-md-12">
                     

                      <div class="col-md-4">
                        <div class="form-group">
                        <label class="control-label col-md-3">Tipo:</label>
                          <div class="col-md-9">
                            <div class="input-group">
                              <select id="tipoMovimiento" class="form-control" style="width: 100%;">
                                <option value="ingreso">Consignación</option>
                                <option value="egreso">Retiro</option>
                                <option value="traslado">Traslado</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <!-- no traslado-->
                      <div id="noTraslado">
                        <div class="col-md-8">
                        <div class="form-group">
                        <label class="control-label col-md-4">Descripción:</label>
                          <div class="col-md-8">
                            <div class="input-group col-md-12">
                              <input type="text" class="form-control col-md-12" id="justificacionMovimiento" placeholder="Describeme el Movimiento" required>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                      <!-- fin no traslado-->
                      

                      <!-- Traslado -->
                      <div id="traslado" style="display: none">
                        <div class="col-md-4">
                        <div class="form-group">
                        <label class="control-label col-md-4">A donde</label>
                          <div class="col-md-8">
                            <div class="input-group">
                              <?php
                                $consultaComun->selectBancos()
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>




                        

                      <div class="col-md-4">
                        <div class="form-group">
                        <label class="control-label col-md-4">Descripción:</label>
                          <div class="col-md-8">
                            <div class="input-group col-md-12">
                              <input type="text" class="form-control col-md-12" id="justificacionTraslado" placeholder="Justificalo" required>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                      <!-- fin traslado-->
                      



                    </div>
               
        <br>
        <br>
        <br>

                      <div class="form-group">
                       
                        <input type="text" id="valorMovimiento" class="inputTextGrande"  onkeyup="format(this)" onchange="format(this)" placeholder="¿Cuánto Moviste?" required>
                      </div>
         

                        
  
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="guardarMovimientoBancario" class="btn btn-success waves-effect waves-light">Registrar el Gasto</button>
                  </div>

                <!-- Fin del formulario -->
                  </form>
                </div>
              </div>
            </div>