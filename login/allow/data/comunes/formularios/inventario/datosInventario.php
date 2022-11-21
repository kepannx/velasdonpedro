<div class="row">
        <div class="col-md-12">
          <div class="panel panel-success">
            <div class="panel-heading" align="center"><i class="ti-hand-point-right"></i>Ingresa aquí la lista de los items que necesites alimentar para  el inventario,  es importante que recuerdes que <br></div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
            <form action="#" class="form-horizontal" data-toggle="validator" name="formObj">
              <div class="form-body">
                <h3 class="box-title"> <i class="fa fa-info-circle"></i> INFORMACIÓN DEL PRODUCTO</h3>
                <hr class="m-t-0 m-b-40">
                 
                <div class="row">

                 <!-- fila 0-->
                  <div class="col-md-12">
                  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-2">Código/SKU</label>
                        <div class="col-md-10" >
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-hashtag"></i></div>
                            <input type="text" name="sku" id="sku" class="typeahead form-control" id="exampleInputuname" placeholder="Código" value="<?php echo $datoProducto['sku']; ?>" data-error="Necesito el Código" autofocus required>
                            
                          </div>

                          <div id="Info" class="col-md-22"></div>
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>
                    </div>



                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="control-label col-md-4">Producto o servicio</label>
                        <div class="col-md-8" >
                          <div class="input-group">
                            <div class="input-group-addon"><i class="ti-shopping-cart"></i></div>
                            <input type="text" name="nombreProductosServicios" id="nombreProductosServicios" class="typeahead form-control" id="exampleInputuname" placeholder="Cómo se llama el producto?" value="<?php echo $datoProducto['nombreProductosServicios']; ?>" data-error="Necesito el nombre del producto" autofocus required>
                            
                          </div>

                          <div id="Info" class="col-md-22"></div>
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>
                    </div>


                  <!-- Selecciona si es un producto o servicio -->
                   <div class="col-md-3 col-xs-12">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-xs-6">Tipo</label>
                        <div class="col-md-10 col-xs-6">
                          <div class="input-group col-md-12">
                          <?php
                                $consultaComun->selectTipoServicioProducto($datoProducto['tipoProductoServicio']);
                          ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  <!-- FIN DE. SELECCIÓN DE PRODUCTO OSERVICIO-->

                  </div>






                    
                  <!-- Fin fila 0-->

                  <div class="col-md-8">
                      <div class="form-group">
                        <label class="control-label col-md-3">Venta al Público:</label>
                        <div class="col-md-9">
                          <div class="input-group col-md-12 col-xs-10">
                            <div class="input-group-addon"><i class="ti-money"></i></div>
                              <input type="text" id="valorVentaUnidad" class="form-control" id="exampleInputuname"  onkeyup="format(this)" onchange="format(this)" value="<?php echo $datoProducto['valorVentaUnidad']; ?>" placeholder="Valor Venta"  >
                          </div>
                        </div>
                      </div>
                    </div> 


                    
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-3">Impuesto</label>
                        <div class="col-md-9">
                          <div class="input-group col-md-12 col-xs-10">
                            <div class="input-group-addon"><i class="fa fa-bank"></i></div>
                              <input type="number" id="impuesto" class="form-control" step="0.1" min='0' max='100' value="<?php echo $datoProducto['impuesto']; ?>" placeholder="Impuesto"  >
                          </div>
                        </div>
                      </div>
                    </div>



                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Alerta A Los</label>
                          <div class="input-group col-md-6">
                            <div class="input-group-addon"><i class="fa fa-bell"></i></div>
                              <input type="number" id="cantidadMinima" min="1" max="999"  class="form-control" value="<?php echo $datoProducto['cantidadMinima']; ?>">
                              <div class="input-group-addon">
                               en existencia
                              </div>
                            </div>
                          </div>
                      </div>



                      <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-4">Mostrar Disponible?</label>
                          <div class="input-group">
                            
                             <?php
                                $consultaComun->selectshowProductoServicio($datoProducto['retiroTemporal']);
                          ?>
                            </div>
                          </div>
                      </div>


                  </div>
                  
                   






                <!-- fila 1-->
                   <!-- Fin fila 0-->


              

                  <!--/span-->
                  
              
 

                <!--/row-->
              </div>
            
            <div class="col-md-12">
              <div class="form-actions" align="center">
                <div class="row">
                        <button type="button" id="guardarDato" class="btn btn-success"> <i class="fa fa-save"></i> Listo! Guarda este item</button>
                    </div>
              </div>
            </div>    
          </form>
              </div>
            </div>
          </div>
        </div>
      </div>