          <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Cómo Llamarás A Tu Nuevo Punto?</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-fort-awesome"></i></div>
                      <input type="text" class="form-control" id="nombrePunto" placeholder="Dime como llamarás a este punto de venta" data-error="Necesito que me digas como se llama el punto" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                
              </div>



              <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-12">¿Cuál Es La Dirección Del Punto?</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-map"></i></div>
                      <input type="text" class="form-control" id="direccion" placeholder="En qué parte se encuentra el punto?" data-error="¿Y dónde queda? sin dirección no puedo guardarlo" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                
              </div>
          </div>




          <div class="col-md-12">




            <div class="col-md-4">
                <div class="form-group">
                    <label >En Qué Departamento Está?</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="ti-map-alt"></i></div>
                      <select class="form-control departamentos" id="departamentos">
                          <?php $consulta->selectDepto(); ?>
                      </select>
                    </div>

                    <div class="help-block with-errors"></div>
                </div>
              </div>



              <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label col-md-12">En Qué Ciudad Está El Punto?</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="ti-map-alt"></i></div>
                      <select class="form-control ciudades" id="ciudadPunto"  data-error="Necesito que me des el nombre de la ciudad" required="">
                       
                          <?php $consulta->selectCiudades(); ?>
                      </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>


              



              <div class="col-md-4">
                <div class="form-group">
                    <label >Tiene Un Sitio Web?</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-edge"></i></div>
                      <input type="text" class="form-control" id="sitioWebPunto" placeholder="Si no tiene no importa :)">
                    </div>
                </div>
              </div>
          </div>

          <div class="col-md-12">
              <div class="col-md-4">
                <div class="form-group">
                    <label >Cuál Es El Teléfono Del Punto</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                      <input type="text" class="form-control" id="telefonoPunto" placeholder="El teléfono aparecerá en facturas">
                    </div>
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label col-md-12">Quién Será El Administrador?</label>
                    <div class="input-group col-md-12">
                      <select id="idAdministrador" class="form-control col-md-12" data-error="Dime quién será el encargado" required >
                        <?php $consulta->selectAdministradorPunto(NULL); ?>
                      </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>

           <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    
                    <div class="input-group">
                  
                      <label class="col-md-10" ><br>Le Activo Una Bodega? </label>
                      <div class="col-md-2">
                        <?php
                          echo $objHtm->checkBodegas(null);
                        ?>
                      </div>
                    </div>
                  
                </div>
              </div>
          
             

          </div>
          
          



          <div class="col-md-12">


             <div class="col-md-4">
                <div class="form-group">
                    <label >Dame El Usuario Con Que Se Accederá</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-user"></i></div>
                      <input type="text" class="form-control" id="username" placeholder="Usuario De Acceso Al Panel" data-error="Sin usuario no hay forma que nadie acceda a vender o a administrar" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                    <label >Ahora Dame Una Contraseña De Acceso</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-key"></i></div>
                      <input type="password" class="form-control" id="password" placeholder="La contraseña con que accederán al panel" data-error="Sin password no puedo dejar entrar a nadie" required>
                    </div>

                     <div class="help-block with-errors"></div>
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                    <label >Repiteme La Contraseña Que Ingresaste</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-key"></i></div>
                      <input type="password" class="form-control" id="passwordMatch" placeholder="Repiteme la contraseña por favor" data-match="#password" data-match-error="Whoops, Repiteme el password porque no coincide"  data-error="Necesito que lo repitas, debo estar seguro que estas segur@ del password" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>
          </div>
            
            <div class="col-sm-12">
              <div class="white-box">
                <label for="input-file-now-custom-1 col-md-12" align="center"> <i class="fa fa-warning"></i> Sube Un Logo, Este Se Mostrará En La Factura, Si no lo tienes, se mostrará por defecto el de la empresa</label>
                <input type="file" id="logo" class="dropify" data-max-file-size="1M" />
              </div>
            </div>