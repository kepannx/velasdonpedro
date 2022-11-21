<div id="abonoDeCreditos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"> <i id='nombreClienteDeuda'></i> va a Abonar a la deuda <i class="fa fa-smile-o"></i> ? </h4>
                  </div>
                  <div class="modal-body">
                    <form name="formObj" action="#">
                      
                      <div class="form-group">
                        <label for="recipient-name" class="control-label">Cuánto va a abonar?:</label>
                        <input type="text" id="abono" class="inputTextGrande"  onkeyup="format(this)" onchange="format(this)" placeholder="¿Cuánto Va a Pagar?" required >
                      </div>
                      <input type="hidden" id="idCliente"  value="<?php echo $consultaComun->encrypt($datoCliente["idcliente"], publickey); ?>">
                      <input type="hidden" id="valorDeuda" value="<?php echo  $datoFactura["deudaFactura"] ?>">
                      <div class="col-md-12">
                        <select class="form-control col-md-12" id="metodoPago">
                          <option value='efectivo'>Efectivo</option>
                          <option value='tarjeta debito'>Tarjeta Debito</option>
                          <option value='tarjeta credito'>Tarjeta Crédito</option>
                          <option value='cheque'>Cheque</option>
                          <option value='entidad crediticia'>Entidad Crediticia</option>
                        </select>
                        <br><br> 
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="guardarDato" class="btn btn-success waves-effect waves-light" align="center">Abona a la deuda!</button>
                  </div>


                  </form>
                </div>
              </div>
            </div>