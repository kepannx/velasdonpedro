          <!-- columna 1 -->
        <div class="col-md-5">
          
              <div class="col-md-12">
                <div class="form-group">
                    <label >Cuál Es El NIT Del Punto</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-certificate"></i></div>
                      <input type="text" class="form-control" id="nitPunto" placeholder="El número de identificación tribtaria" data-error="Necesito que me des el NIT para temas legales" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>

              </div>


              <div class="col-12">
                <div class="form-group">
                    <label >A Cuál Régimen Pertenece?</label>
                    <div class="input-group col-md-12">
                     
                      <select id="regimenTributario" class="form-control col-md-12" >
                        <?php $objHtm->selectTiposRegimenTributario(NULL); ?>
                      </select>
                      
                    </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="form-group">
                    <label >Quién Será El Representante Legal?</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-star"></i></div>
                      <input type="text" class="form-control" id="representanteLegal" placeholder="Quien aparece como representante?" data-error="Quién es el que responde ante los organos de control?" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="form-group">
                    <label >Formato De Impresión Predeterminada </label>
                    <div class="input-group col-md-12">
                       <select id="formatoImpresion" class="form-control col-md-12" >
                        <?php $objHtm->selectFormatoImpresion(NULL); ?>
                       </select>
                    </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                    <label >Iniciar a Facturar Apartir Del Número: </label>
                    <div class="input-group col-md-12">
                      <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-number"></i></div>
                      <input type="number" class="form-control" id="nroInicioFactura" placeholder="Empezar a facturar desde qué número?" min='0' value="" data-error="Dime desde que número empiezo el consecutivos" required>
                    </div>
                    </div>
                </div>
              </div>

        </div>
        <!-- fin columna 1 -->
        <!-- columna 2 -->
        <div class="col-md-7">
   
                <div class="form-group">
                    <label class="col-md-12" align="center">Términos Y Condiciones De La Factura</label>
                    <div class="input-group col-md-12">
                      <textarea class="summernote" id="terminosCondicionesFactura">
                        
                      </textarea>
                   
                    </div>
                </div>
        </div>
         <!-- fin columna 2 -->