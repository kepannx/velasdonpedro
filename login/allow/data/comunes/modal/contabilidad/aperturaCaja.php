            <div id="aperturaCaja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" align="center">Quieres abrir caja para el día <?php echo $consultaComun->fechaHumana(date("Y-m-d", fechaActualFija)); ?> ? </h4>
                  </div>
                  <div class="modal-body">
                    <form method="POST" name="aperturaCaja">
                      
                      <div class="form-group">
                        <label for="recipient-name" class="control-label">¿Con Cuánto La Vas a Abrir?</label>
                        <input type="text" id="valorCajaBase" class="inputTextGrande" id="recipient-name" onkeyup="format(this)" onchange="format(this)" placeholder="¿Cuál Es La Base?">
                      </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success waves-effect waves-light" id="abrirCaja">Abrir Caja</button>
                  </div>


                  </form>
                </div>
              </div>
            </div>