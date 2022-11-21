<div class="row">
        <div class="col-md-12">
          <div class="panel panel-success">
            <div class="panel-heading" align="center"><i class="ti-hand-point-right"></i>Ingresa aquí la lista de los items que necesites alimentar para  el inventario,  es importante que recuerdes que <br><strong class="text-danger"> si algún producto hace parte de una receta, este producto NO SE MOSTRARÁ EN EL POS DE VENTA FINAL</strong></div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
            <form action="#" class="form-horizontal" name="clientForm" method="POST">
              <div class="form-body">
                <h3 class="box-title">INFORMACIÓN DEL PRODUCTO</h3>
                <hr class="m-t-0 m-b-40">
                 
                <div class="row">

                 <!-- fila 0-->
                  <div class="col-md-12">

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-3">Producto</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <dt style="padding-top:8px;" class="text-danger"><?php echo $productoId; ?></dt>
                            <input type="hidden" name="productoId" value="<?php echo $productoId; ?>">
                          </div>
                        </div>
                        </div>
                      </div>


                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-2">Medida</label>
                          <div class="col-md-10">
                            <div class="input-group">
                            <dt style="padding-top:8px;" class="text-danger"><?php echo $consultaComun->stringMedidas($inventarioConvenioMedida[0]); ?></dt>
                            <input type="hidden" name="productoConvenioMedida" value="<?php echo $inventarioConvenioMedida[0]; ?>">
                          </div>
                        </div>
                      </div>
                    </div>



                    <!-- Valor Venta-->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-5">Lo venderás a:</label>
                        <div class="col-md-7">
                          <div class="input-group col-md-9 col-xs-10">
                          <dt style="padding-top:8px;" class="text-danger"><?php echo number_format($consultaComun->normalizaciondecaracteres($inventarioConvenioValorCompra)); ?></dt>
                            <input type="hidden" name="productosConvenioValor" value="<?php echo $inventarioConvenioValorCompra; ?>">
                          </div>
                        </div>
                      </div>
                    </div> 
                    <!-- Fin Valor Venta-->
                  </div>

                  <!-- Fin fila 0-->


                <!-- fila 1-->
                  <div class="col-md-12">
                    
              
                   



                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-8">¿Aplicará Para Receta?</label>
                        <div class="col-md-4">
                          <div class="input-group">
                            <dt style="padding-top:8px;" class="text-danger"><?php echo $consultaComun->stringAplicaReceta($inventarioConvenioReceta); ?></dt>
                            <input type="hidden" name="productosConvenioProductoReceta" value="<?php echo $inventarioConvenioReceta; ?>">

                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Alerta A Los</label>


                        <div class="input-group">
                            <dt style="padding-top:8px;" class="text-danger"><?php echo $productosConvenioMinimo." ".$consultaComun->stringMedidas($inventarioConvenioMedida); ?></dt>
                            <input type="hidden" name="productosConvenioMinimo" value="<?php echo $productosConvenioMinimo; ?>">
                          </div>
                      </div>
                    </div>






                  </div>
                  <!-- Fin fila 1-->

                 
                  <!--/span-->
                  
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="confirmacion" value="2">

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