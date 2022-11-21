<div id="registrarGasto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" align="center">Estas Por Registrar Un Gasto </h4>
                  </div>
                  <div class="modal-body">
                    <form name="egreso">
                    <!-- Inicio de formulario-->
                    <div class="col-md-12">
                     

                      <div class="col-md-3">
                        <div class="form-group">
                        <label class="control-label col-md-4">Tipo:</label>
                          <div class="col-md-8">
                            <div class="input-group">
                              <select id="tipoEgresoGasto" class="form-control" style="width: 100%;">
                                <option value="gasto">Gasto</option>
                                <option value="egreso">Egreso</option>
                              </select>
                            </div>
                          </div>
                        </div>


                      </div>
                      

                      <div class="col-md-5">
                        <div class="form-group">
                        <label class="control-label col-md-4">Provedor:</label>
                          <div class="col-md-8">
                            <div class="input-group col-md-12">
                              <input type="text" class="form-control col-md-12" id="provedor" placeholder="A quien lo pagas?" required>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-4">
                        <div class="form-group">
                        <label class="control-label col-md-5">Nro Recibo:</label>
                          <div class="col-md-7">
                            <div class="input-group col-md-12">
                              <input type="text" class="form-control col-md-12" id="nroRecibo" placeholder="#" required>
                            </div>
                          </div>
                        </div>
                      </div>



                    </div>

                    <br><br>
                    <br>
                    <div class="col-md-12">                     
                       <div class="form-group">
                        <label class="control-label col-md-2">Descripción:</label>
                          <div class="col-md-10">
                            <div class="input-group col-md-12">
                              <input type="text" class="form-control col-md-12" id="descripcion" placeholder="Brevemente, ¿Qué pagarás?" required>
                            </div>
                          </div>
                        </div>
                    </div>
               
        <br>
        <br>
        <br>

                      <div class="form-group">
                       
                        <input type="text" id="valorEgresoGasto" class="inputTextGrande"  onkeyup="format(this)" onchange="format(this)" placeholder="¿Cuánto Salió?" required>
                      </div>
         

                        
  
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="guardarDato" class="btn btn-success waves-effect waves-light">Registrar el Gasto</button>
                  </div>

                <!-- Fin del formulario -->
                  </form>
                </div>
              </div>
            </div>