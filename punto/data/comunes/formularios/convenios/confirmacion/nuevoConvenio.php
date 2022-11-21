<div class="row">
        <div class="col-md-12">
          <div class="panel panel-success">
            <div class="panel-heading" align="center"><i class="ti-hand-point-right"></i> Aqui puedes crear nuevos convenios, automáticamente  le haré un punto de administración de venta  donde el administrador del convenio pueda crear  sus productos,  controlar  su caja y su inventario.</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
            <form action="#" class="form-horizontal" method="POST">
              <div class="form-body">
                <h3 class="box-title">Información Básica Del convenio</h3>

              <div class="alert alert-success alert-danger" style="background-color: #f00;" align="center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="fa fa-warning"></i> Por favor, verifica que estos sean los datos correctos que quieres que ingrese a mi base de datos. 
              </div>


                <hr class="m-t-0 m-b-40">
                

                <div class="row">
                  

                <!-- fila 1-->
                  <div class="col-md-12">
                  
                  <!-- Avisos -->

                  <!-- Fin de Avisos-->



                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Nombre del Convenio</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <dt style="padding-top:10px;"><?php echo $convenioNombre; ?></dt>
                            <input type="hidden" name="convenioNombre" value="<?php echo $convenioNombre; ?>">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Email Administrador</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <dt style="padding-top:10px;"><?php echo $convenioEmail; ?></dt>
                            <input type="hidden" name="convenioEmail" value="<?php echo $convenioEmail; ?>">
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- Fin fila 1-->

                  <!-- fila 2-->
                  <div class="col-md-12">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">¿Qué usuario le asignarás?</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <dt style="padding-top:10px;"><?php echo $convenioUsuario; ?></dt>
                            <input type="hidden" name="convenioUsuario" value="<?php echo $convenioUsuario; ?>">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Contraseña de Acceso</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <dt style="padding-top:10px;"><?php echo $consultaComun->enmascararContrasena($convenioClave); ?></dt>
                            <input type="hidden" name="convenioClave" value="<?php echo $convenioClave; ?>">
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- Fin fila 2-->

                </div>
                  <!--/span-->
                  
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="confirmacion" value="2">

                <!--/row-->
              </div>
            
            <div class="col-md-12">
              <div class="form-actions" align="center">
                <div class="row">
                        <button type="submit" class="btn btn-success">Si! Los Datos Estan Correctos!</button>
                    </div>
              </div>
            </div>
              
          </form>
              </div>
            </div>
          </div>
        </div>
      </div>