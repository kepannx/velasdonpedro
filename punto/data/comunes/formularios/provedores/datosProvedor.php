<div class="row">
        <div class="col-md-12">
          <div class="panel panel-info">
            <div class="panel-heading" align="center"><i class="ti-hand-point-right"></i>
                Ingresa aquí los datos básicos del provedor
             <br></div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
            <form action="#" class="form-horizontal" name="formObj" data-toggle="validator">
              <div class="form-body">
                <h3 class="box-title"> <i class="fa fa-info-circle"></i> INFORMACIÓN DEL PROVEDOR</h3>
                <hr class="m-t-0 m-b-40">
                 
                <div class="row" >
                 <!-- fila 0-->
                  <div class="col-md-12">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-5">Nombre del Provedor</label>
                        <div class="col-md-7">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="ti-shopping-cart"></i></div>
                            <input type="text"  id="nombreProvedor"  class="typeahead form-control" value="<?php echo $datoProvedor['nombreProvedor']; ?>"  placeholder="Cómo se llama el provedor?" required>
                         
                          </div>
                        </div>
                      </div>
                    </div>



                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-5">Identificación Tributaria</label>
                        <div class="col-md-7">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-certificate"></i></div>
                            <input type="text"  id="ideProvedor" class="typeahead form-control" value="<?php echo $datoProvedor['ideProvedor']; ?>"    placeholder="Nit o Identificación tributaria" required>
                         
                          </div>
                        </div>
                      </div>
                    </div>




                  </div>






                    
                  <!-- Fin fila 0-->

                  <div class="col-md-12">
                    

                    <div class="col-md-4 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-xs-2"">Dirección</label>
                        <div class="col-md-9 col-xs-10" id="listaProvedores">
                          <div class="input-group col-md-12 col-xs-10">
                             <input type="text"  id="direccionProvedor" class="typeahead form-control"  value="<?php echo $datoProvedor['direccionProvedor']; ?>"   placeholder="Dónde ubicas al provedor?" required>
                          </div>
                        </div>
                      </div>
                    </div>



                    <div class="col-md-4 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-xs-6">Ciudad</label>
                        <div class="col-md-9 col-xs-6">
                          <div class="input-group">
                            <input type="text"  id="ciudadProvedor" class="typeahead form-control"  value="<?php echo $datoProvedor['ciudadProvedor']; ?>"  placeholder="De qué ciudad es?" required>
                          </div>
                        </div>
                      </div>
                    </div>





                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-3">Teléfono</label>
              
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                              <input type="text" id="telefonoProvedor" value="<?php echo $datoProvedor['telefonoProvedor']; ?>" placeholder="Teléfono"  class="form-control">
                              
                            </div>
                          </div>
                      </div>
                  </div>


                <!-- fila 1-->
                   <!-- Fin fila 0-->


                <!-- fila 1-->
                  <div class="col-md-12">
                    <div class="col-md-4 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-xs-2"">Email</label>
                        <div class="col-md-10 col-xs-10">
                          <div class="input-group col-md-12 col-xs-12">
                             <input type="email" id="emailProvedor" class="typeahead form-control" value="<?php echo $datoProvedor['emailProvedor']; ?>"   placeholder="Correo Electrónico " required>
                          </div>
                        </div>
                      </div>
                    </div>



                    <div class="col-md-8 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-xs-2"">Contacto</label>
                        <div class="col-md-9 col-xs-10" id="listaProvedores">
                          <div class="input-group col-md-9 col-xs-10">
                             <input type="text" id="contactoProvedor" class="typeahead form-control"   value="<?php echo $datoProvedor['contactoProvedor']; ?>"   placeholder="A quién contáctas de esta empresa?"required>
                          </div>
                        </div>
                      </div>
                    </div>

                  

                    
                     

                    

                  </div>
                  <!-- Fin fila 1-->

                  <!--/span-->
                  
             
             
                <!--/row-->
              </div>
            
            <div class="col-md-12">
              <div class="form-actions" align="center">
                <div class="row">
                        <button type="button" id="guardarDato" class="btn btn-success"> <i class="fa fa-save"></i> Listo! Guárdame este provedor</button>
                    </div>
              </div>
            </div>    
          </form>
              </div>
            </div>
          </div>
        </div>
      </div>

  