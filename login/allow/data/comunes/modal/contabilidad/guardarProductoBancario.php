<div id="creacionProductoBancario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" align="center">¿ <i class="fa fa-bank"></i>Vamos a Crear un Nuevo Producto Bancario? </h4>
                  </div>
                  <div class="modal-body">
                    <form name="formObj" action="#">
                        <p>Si tienes una tarjeta de crédito o un prestamo, crealo aquí, relacionalo al banco y te ayudaré a llevar y controlar mejor las cuentas</p>
                      


                      <div class="form-group">
                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Tipo de Producto</label>
                           <?php
                              echo $consultaComun->selectTipoProductoBanco(NULL);
                              ?>
                        </div>

                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Banco</label>
                              <?php

                              if (!isset($idBanco)) {
                                # code...
                                echo $consultaComun->selectBancos(NULL);
                              }
                              else
                              {
                                echo '<div class="col-md-12"><h3>'.$datoBanco['nombreBanco'].'</h3></div>';
                              }




                              
                              ?> 
                        </div>
                        
                        
                      </div>



                      <div class="form-group">
                        <div class="col-md-12">
                          <label for="recipient-name" class="control-label">Descripcion</label>
                              <input type="text" id="descripcion" class="form-control" placeholder="Describe el producto"  required>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        

                        <div class="col-md-4">
                          <label for="recipient-name" class="control-label">Saldo </label>
                          <input type="text" id="saldo" class="form-control" placeholder="Con cuanto iniciará" onkeyup="format(this)" onchange="format(this)" required>
                        </div>


                        <div class="col-md-4">
                          <label for="recipient-name" class="control-label">Deuda</label>
                          <input type="text" id="deuda" class="form-control" placeholder="Debemos Algo De Este Producto?" onkeyup="format(this)" onchange="format(this)" required>
                        </div>


                        <div class="col-md-4">
                          <label for="recipient-name" class="control-label">Fecha de Corte</label>
                          <div class="input-group">
                              <input type="text"  id="fechaCorte" class="form-control complex-colorpicker" placeholder="mm/dd/yyyy" value="" required>
                                <span class="input-group-addon"><i class="icon-calender"></i></span> 
                            </div>
                        </div>
                        
                      
                      </div>


                    
                    
                  </div>
                  <div class="modal-footer" >
                    <button type="button" id="guardarProductoBancario" class="btn btn-success waves-effect waves-light col-md-12" style="margin-top: 10px;"> <i class="fa fa-save"></i> Crear Producto</button>
                  </div>


                  </form>
                </div>
              </div>
            </div>