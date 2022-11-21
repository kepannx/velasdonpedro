<div id="creacionBancos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" align="center">¿ <i class="fa fa-bank"></i>Vamos a Crear un Nuevo Banco? </h4>
                  </div>
                  <div class="modal-body">
                    <form name="formObj" action="#">
                      
                      <div class="form-group">
                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Cómo se llama el banco?:</label>
                          <input type="text" id="nombreBanco" class="form-control" placeholder="Nombre Del Banco">
                        </div>

                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Número Cuenta</label>
                          <input type="text" id="nroCuenta" class="form-control" placeholder="Número de la Cuenta">
                        </div>
                        
                        
                      </div>



                      <div class="form-group">
                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Tipo de Cuenta</label>
                              <?php
                               $consultaComun->selectTiposCuenta(NULL);
                              ?>
                        </div>

                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Saldo</label>
                          <input type="text" id="saldo" class="form-control" placeholder="Con cuanto iniciará" onkeyup="format(this)" onchange="format(this)" required>
                        </div>
                        
                      </div>

                    
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="guardarBanco" class="btn btn-success waves-effect waves-light">Crear Banco</button>
                  </div>


                  </form>
                </div>
              </div>
            </div>