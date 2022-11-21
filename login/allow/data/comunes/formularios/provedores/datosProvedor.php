          <div class="col-md-12">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Cómo Se Llama El Provedor?</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-fort-awesome"></i></div>
                      <input type="text" class="form-control" id="nombreProvedor" placeholder="Dime como se llama el provedor" data-error="Necesito que me digas como se llama el provedor" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                
              </div>



              <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label col-md-12">Dirección Principal</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-map"></i></div>
                      <input type="text" class="form-control" id="direccionProvedor" placeholder="En qué parte se encuentra el provedor?" data-error="¿Y dónde queda? sin dirección no puedo guardarlo" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                
              </div>



              <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label col-md-12">Identificación</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-tag"></i></div>
                      <input type="text" class="form-control" id="ideProvedor" placeholder="En qué parte se encuentra el provedor?" data-error="¿Y dónde queda? sin dirección no puedo guardarlo" required>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>

              </div>


          <div class="col-md-12">
              <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label col-md-12">Régimen</label>
                    <div class="input-group">
                      <select id="regimenProvedor" class="form-control">
                            <?php $consulta->selectRegimenEmpresa(); ?>
                      </select>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>


              <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label col-md-12">Persona Jurídica</label>
                    <div class="input-group">
                      <select id="regimenProvedor" class="form-control">
                            <?php  $consulta->selectPersonasJuridicas(); ?>
                      </select>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>





            <div class="col-md-3">
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



              <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label col-md-12">Ciudad Ubicación</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="ti-map-alt"></i></div>
                      <select class="form-control ciudades" id="ciudadProvedor"  data-error="Necesito que me des el nombre de la ciudad" required="">
                       
                          <?php $consulta->selectCiudades(); ?>
                      </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>

              
              



            <!-- 

              

            -->
          </div>

          <div class="col-md-12">
              <div class="col-md-3">
                <div class="form-group">
                    <label >Cuál Es El Teléfono Del Punto</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                      <input type="text" class="form-control" id="telefonoProvedor" placeholder="El teléfono del provedor">
                    </div>
                </div>
              </div>


              <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label col-md-12">Nombre Contacto</label>
                    <div class="input-group col-md-12">
                      <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-user"></i></div>
                      <input type="text" class="form-control" id="contactoProvedor" placeholder="A quién contactarás donde el provedor?">
                    </div>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>


        <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label col-md-12">Correo Electrónico</label>
                    <div class="input-group col-md-12">
                      <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-at"></i></div>
                      <input type="email" class="form-control" id="emailProvedor" placeholder="Cuál es el correo electronico?">
                    </div>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>

        <div class="col-md-3">
                <div class="form-group">
                    <label >Tiene Un Sitio Web?</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-edge"></i></div>
                      <input type="text" class="form-control" id="sitioWebProvedor" placeholder="Si no tiene no importa :)">
                    </div>
                </div>
              </div>
          </div>
          
