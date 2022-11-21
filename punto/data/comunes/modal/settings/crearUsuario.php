<div id="creacionUsuarios" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" align="center"><i class="fa fa-user"></i>¿ Vamos a Crear un Nuevo usuario? </h4>
                  </div>
                  <div class="modal-body">
                    <form name="formObj" action="#">
                      
                      <div class="form-group">
                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Nombre Del Empleado?:</label>
                          <input type="text" id="nombre" class="form-control" placeholder="Cómo se llama?" required>
                        </div>

                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Email</label>
                          <input type="email" id="email" class="form-control" placeholder="Correo Electrónico">
                        </div>                        
                      </div>



                      <div class="form-group">
                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Tipo de Usuario</label>
                              <?php
                               $consultaComun->selectTiposUsuario(NULL);
                              ?>
                        </div>

                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">codigo</label>
                          <input type="number" id="codigo" class="form-control" value="<?php  echo $consultaComun->proximoCodigoUsuario()?>" readonly >
                        </div>
                        
                        
                      </div>


                      <div class="form-group">
                        <div class="col-md-6">
                        <label for="recipient-name" class="control-label">Usuario</label>
                          <div class="input-group">

                            <div class="input-group-addon"><i class="ti-user"></i></div>
                            <input type="text" class="form-control" id="usuario" placeholder="Usuario">
                          </div>

                        </div>

                        <div class="col-md-6">
                          <label for="recipient-name" class="control-label">Contraseña</label>
                          <input type="password" id="contrasena" class="form-control" placeholder="Contraseña de Acceso">
                        </div>                        
                      </div>
    



                    
                    
                  </div>
                  <div class="modal-footer" style="margin-top: 10px;">

                    <button type="button" id="guardarUsuario" class="btn btn-success waves-effect waves-light col-md-12">Crear Usuario</button>
                  </div>


                  </form>
                </div>
              </div>
            </div>