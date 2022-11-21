<div id="imprimirFactura" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <?php
                    if ($datoFactura['nroFactura']!==NULL) {
                      $modoFactura='Factura';
                    }else{
                      $modoFactura='Cuenta de Cobro';
                    }


                      echo $facturero->tiposFacturas($datoFactura['idFactura'], "mediaCarta", $modoFactura, $datoFactura['incremento']);
                  ?>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="noPrint" class="btn btn-success waves-effect waves-light" onclick="window.print();"><i class="fa fa-print"></i>Imprimir</button>
                  </div>


                  </form>
                </div>
              </div>
            </div>