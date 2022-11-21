        <!-- DATOS FACTURACIÓN PARA PUNTOS DE VENTA DE RÉGIMEN SIMPLIFICADO -->
        <div class="col-md-12" id="noPrint">



              <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label col-md-12">Tipo Documento</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa id-card"></i></div>
                        <div id="tipoCliente">
                            <select id="tipoDocumento" class="form-control">
                              <option value="Cedula Ciudadania">C.C</option>
                              <option value="NIT">NIT</option>
                              <option value="pasaporte">Pasaporte</option>
                              <option value="Cedula de Extranjeria">C.E</option>
                              <option value="Tarjeta de Identidad">C.E</option>
                              <option value="Otro">Otro</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>



              <div class="col-md-4" id="ideCliente">
                <div class="form-group">
                    <label class="control-label col-md-12">Identificación</label>
                    <div class="input-group" id="idenCliente">
                      <div class="input-group-addon"><i class="fa fa-hashtag"></i></div>
                      <input type="text" class="form-control typeahead" id="identificacionCliente" placeholder="cédula, nit, algo! " value="" data-error="Debes decirme la identificación del cliente " required>
                    </div>
                </div>
              </div>


              <div class="col-md-3">
                <div class="form-group">
                    <label>Cómo Se Llama El Cliente?</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-user"></i></div>
                      <input type="text" class="form-control" id="nombreCliente" placeholder="Preguntale Su Nombre" value="" data-error="Necesito Saber Cómo Se Llama El Cliente" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>


            
              <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label col-md-12">Cuál es Su Email</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="ti-email"></i></div>
                      <input type="email" class="form-control" id="emailCliente" placeholder="Genial si tienes su email" value="" >
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                
              </div>



              <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label col-md-12">En Qué Ciudad Vive?</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa  fa-home"></i></div>
                      <input type="text" class="form-control" id="ciudadCliente" placeholder="Donde Vive El Cliente?" value="" >
                    </div>
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label col-md-12">Pidele La Dirección</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa   fa-map-marker"></i></div>
                      <input type="text" class="form-control" id="direccionCliente" placeholder="Cuál es la dirección?" value="" >
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label col-md-12">A Qué Teléfono Podemos Llamarlo?</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa   fa-phone"></i></div>
                      <input type="text" class="form-control" id="telefonoCliente" placeholder="Celular o Fijo " value="" >
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>
          </div>