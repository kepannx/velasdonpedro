<div class="row">
        <div class="col-md-12">
          <div class="panel panel-success">
            <div class="panel-heading" align="center"><i class="ti-hand-point-right"></i> Aqui debes registrar los gastos que has hecho durante el dí</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
            <form action="#" class="form-horizontal">
              <div class="form-body">
                <h3 class="box-title">Información Básica Del convenio</h3>
                <hr class="m-t-0 m-b-40">
           

                <div class="row">
                  

                <!-- fila 1-->
                  <div class="col-md-12">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Nombre del Convenio</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="ti-user"></i></div>
                            <input type="text" name="convenioNombre" class="form-control" id="exampleInputuname" value="<?php echo $datosConvenio["convenioNombre"]; ?>" placeholder="Dime el nombre del convenio" required>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Email Administrador</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="ti-email"></i></div>
                            <input type="email" name="convenioEmail" class="form-control" id="exampleInputuname" value="<?php echo $datosConvenio["convenioEmail"]; ?>" placeholder="Cuál es el email del administrador?">
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
                            <div class="input-group-addon"><i class="ti-user"></i></div>
                            <input type="text" name="convenioUsuario" class="form-control" id="exampleInputuname"  value="<?php echo $consultaComun->decrypt($datosConvenio["convenioUsuario"], key); ?>" placeholder="Dime el usuario para este convenio" required>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Contraseña de Acceso</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="ti-key"></i></div>
                           
                            <input type="password" name="convenioClave" class="form-control" id="exampleInputuname" placeholder="<?php echo $placeholder; ?>">
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- Fin fila 2-->

                </div>
                  <!--/span-->
                  
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="confirmacion" value="1">

                <!--/row-->
              </div>
            
            <div class="col-md-12">
              <div class="form-actions" align="center">
                <div class="row">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Listo! guarda esta información que quiero para este convenio</button>
                    </div>
              </div>
            </div>    
          </form>
              </div>
            </div>
          </div>
        </div>
      </div>