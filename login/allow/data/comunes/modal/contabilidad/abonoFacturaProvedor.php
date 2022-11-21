<div id="abonoFacturaProvedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Vamos a abonarle a esta deuda <i class="fa fa-smile-o"></i> ? </h4>
                  </div>
                  <div class="modal-body">
                    <form name="formObj" action="#">
                      
                      <div class="form-group">
                        <div class="col-md-6">
                           <label for="recipient-name" class="control-label">Cuánto le vamos a abonar?:</label>
                        
                        <input type="text" id="abono" class="form-control"  onkeyup="format(this)" onchange="format(this)" placeholder="¿Cuánto Va a Pagar?" required >
                        </div>

                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">De dónde lo debito?</label>
                          <?php
                              $consultaComun->selectProductosDebitar();
                          ?>
                        </div>
                       



                      </div>
                      <input type="hidden" id="idfacturaProvedor"  value="<?php echo $consultaComun->encrypt($datoFactura["idfacturaProvedor"], publickey); ?>">
                      <input type="hidden" id="deudaFacturaProvedor" value="<?php echo $datoFactura["deudaFacturaProvedor"]; ?>">
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="abonarDeudaProvedor" class="btn btn-success waves-effect waves-light">Abona a la deuda!</button>
                  </div>


                  </form>
                </div>
              </div>
            </div>