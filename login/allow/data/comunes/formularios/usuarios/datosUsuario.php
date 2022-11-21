<div class="row">
        <div class="col-md-12">
          <div class="panel panel-info">
           
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
            <form action="#" class="form-horizontal" name="formObj" data-toggle="validator">
              <div class="form-body">
                <h3 class="box-title"> <i class="fa fa-info-circle"></i> INFORMACIÓN DEL USUARIO</h3>
                <hr class="m-t-0 m-b-40">
                 
                <div class="row" >
                 <!-- fila 0-->
                  <div class="col-md-12">
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-3">Nombres</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text"  id="nombre"  class="typeahead form-control" value="<?php echo $datosUser['nombre']; ?>"  placeholder="Cómo se llama el usuario?" required>
                          </div>
                        </div>
                      </div>
                    </div>



                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-5">Identificación</label>
                        <div class="col-md-7">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-certificate"></i></div>
                            <input type="text"  id="identificacion" class="form-control" value="<?php echo $datosUser['identificacion']; ?>"    placeholder="Cédula o Id" required>
                         
                          </div>
                        </div>
                      </div>
                    </div>




                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-3">Dirección</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa  fa-home"></i></div>
                            <input type="text"  id="direccion" class="form-control" value="<?php echo $datosUser['direccion']; ?>"    placeholder="Dónde Lo Ubicamos?" required>
                         
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

                    
                  <!-- Fin fila 0-->

                  <div class="col-md-12">
                    

                     <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-3">Teléfonos</label>
              
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                              <input type="text" id="telefonos" value="<?php echo $datosUser['telefonos']; ?>" placeholder="Número de tel o cel"  class="form-control">
                              
                            </div>
                          </div>
                      </div>



                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-3">Ciudad</label>
              
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa  fa-map-marker"></i></div>
                              <input type="text" id="ciudad" value="<?php echo $datosUser['ciudad']; ?>" placeholder="Dónde vive?"  class="form-control">
                              
                            </div>
                          </div>
                      </div>



                      <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-3">Email</label>
              
                          <div class="input-group">
                            <div class="input-group-addon">@</div>
                              <input type="email" id="email" value="<?php echo $datosUser['email']; ?>" placeholder="Dónde vive?"  class="form-control">
                              
                            </div>
                          </div>
                      </div>




                  
                  </div>


                <!-- fila 1-->
                   <!-- Fin fila 0-->


                <!-- fila 1-->
                  <div class="col-md-12">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label col-md-5">Tipo de Usuario</label>
              
                          <div class="input-group">
                             <?php
                            $consultaComun->selectTiposUsuario($datosUser['tipoUsuario'])
                          ?>
                          </div>
                      </div>
                    </div>


                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label col-md-7">Código Vendedor</label>
              
                          <div class="input-group">
                            
                            <strong class="btn btn-info">
                               <?php echo $datosUser['codigo']; ?>
                            </strong>
                          
                          </div>
                      </div>
                    </div>
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-6">Punto de Venta:</label>
              
                          <div class="input-group">
                           <select id="puntoAsignado" class="form-control col-md-12">

                             <?php echo $consulta->loadSelectPuntosVentas($datosUser['puntoAsignado']); ?>
                            </select>                          
                          </div>
                      </div>
                    </div>




                     <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label col-md-6">Estado Usuario</label>
              
                          <div class="input-group">
                            
                           <?php $consultaComun->selectActivarDesactivar($datosUser['activada']); ?>
                          
                          </div>
                      </div>
                    </div>


                <div class="col-md-12">
                 
                <h3 class="box-title"> <i class="fa fa-gavel"></i> Datos Laborales</h3>
                <hr>
                </div>

                <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-3">Eps</label>
              
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa  fa-hospital-o"></i></div>
                              <input type="text" id="eps" value="<?php echo $datosUser['eps']; ?>" placeholder="¿A cuál está afiliado?"  class="form-control">
                              
                            </div>
                      </div>
                </div>


                <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-3">IPS</label>
              
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa  fa-stethoscope"></i></div>
                              <input type="text" id="ips" value="<?php echo $datosUser['ips']; ?>" placeholder="¿A cuál está afiliado?"  class="form-control">
                              
                            </div>
                      </div>
                </div>


                <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-3">ARP</label>
              
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa  fa-user-md"></i></div>
                              <input type="text" id="arp" value="<?php echo $datosUser['arp']; ?>" placeholder="¿A cuál está afiliado?"  class="form-control">
                              
                            </div>
                      </div>
                </div>



                <div class="col-md-5">
                      <div class="form-group">
                        <label class="control-label col-md-6">Caja de Compensación</label>
              
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa  fa-archive"></i></div>
                              <input type="text" id="cajasCompensacion" value="<?php echo $datosUser['cajasCompensacion']; ?>" placeholder="¿A cuál está afiliado?"  class="form-control">
                              
                            </div>
                      </div>
                </div>



                <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label col-md-5">Cesantías</label>
              
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-check-square"></i></div>
                              <input type="text" id="cesantias" value="<?php echo $datosUser['cesantias']; ?>" placeholder="¿A cuál está afiliado?"  class="form-control">
                              
                            </div>
                      </div>
                </div>



                <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-5">Sueldo Promedio</label>
              
                          <div class="input-group">
                            <div class="input-group-addon">$</div>
                              <input type="text" id="sueldoPromedio" value="<?php echo $datosUser['sueldoPromedio']; ?>" placeholder="Cuánto Gana de Base"  class="form-control" onkeyup="format(this)" onchange="format(this)">
                              
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
                        <button type="button" id="actualizaDatos" class="btn btn-success"> <i class="fa fa-save"></i>Actualizame los datos de <?php  $nombre=explode(" ", $datosUser['nombre']); echo $nombre[0]; ?></button>
                    </div>
              </div>
            </div>    
          </form>
              </div>
            </div>
          </div>
        </div>
      </div>

  