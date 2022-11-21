<div id="crearBodegas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" align="center"> <i class="fa fa-warning"></i> Estas Por Crear Una Nueva Bodega </h4>
                    
                  </div>
                  <div class="modal-body">
                
                          <div class="col-md-6">
                            <label>Cómo llamarás esta Bodega?</label>
                            <input type="text" id="nombreBodega" class="form-control" placeholder="Dime con que nombre quieres identificarlo">
                          </div>

                          <div class="col-md-6">
                            <label>Que tipo es?</label>
                            <select id="tipo" class="form-control">
                              <option value="base">Base</option>
                              <option value="vip">V.I.P</option>
                            </select>
                          </div>

                          <div class="col-md-6">
                            <label>Relacionar Con</label>
                            <select id="matricula" class="form-control" multiple require>
                              <option>Selecciona Un Punto De Venta</option>}
                              option
                              <?php
                                echo $consultaComun->selectPunto();
                              ?>
                            </select>
                          </div>


                          <div class="col-md-6">
                            <button type="submit" id="guardarBodega" class="btn btn-success waves-effect waves-light col-md-12"  style="margin-top: 20px; height: 100px;"><i class="fa fa-file"></i> Crear Bodega</button>
                          </div>                          
  
                  </div>
                  <div class="modal-footer">
                   
                  </div>
               

                <!-- Fin del formulario -->
                  </form>
                </div>
              </div>
            </div>