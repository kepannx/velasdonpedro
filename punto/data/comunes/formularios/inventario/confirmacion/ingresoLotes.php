<div class="row">
        <div class="col-md-12">
          <div class="panel panel-success">
            <div class="panel-heading" align="center"><i class="ti-hand-point-right"></i>Ingresa aquí la lista de los items que necesites alimentar para  el inventario,  es importante que recuerdes que <br><strong class="text-danger"> si algún producto hace parte de una receta, este producto NO SE MOSTRARÁ EN EL POS DE VENTA FINAL</strong></div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
            <form action="#" class="form-horizontal" name="clientForm" method="POST">
              <div class="form-body">
                <h3 class="box-title">INFORMACIÓN DEL PEDIDO</h3>
                <hr class="m-t-0 m-b-40">
                 
                <div class="row">

                 <!-- fila 0-->
                  <div class="col-md-12">
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-3">Provedor</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <dt style="padding-top:8px;" class="text-danger"><?php echo $idProvedor; ?></dt>
                            <input type="hidden" name="idProvedor" value="<?php echo $idProvedor; ?>">
                          </div>
                        </div>
                      </div>
                    </div>




                     <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label col-md-5">Nro Factura</label>
                        <div class="col-md-7">
                          <div class="input-group">
                            <dt style="padding-top:8px;" class="text-danger"><?php echo $nroFacturaProvedor; ?></dt>
                            <input type="hidden" name="nroFacturaProvedor" value="<?php echo $nroFacturaProvedor; ?>">
                          </div>
                        </div>
                      </div>
                    </div>



                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-6">¿Cuándo Lo Compraste?</label>
                        <div class="col-md-6">
                          <div class="input-group">
                            <dt style="padding-top:8px;" class="text-danger"><?php echo $fechaFacturaProvedor; ?></dt>
                            <input type="hidden" name="fechaFacturaProvedor" value="<?php echo $fechaFacturaProvedor; ?>">
                          </div>
                        </div>
                      </div>
                    </div>



                  </div>
                  <!-- Fin fila 0-->


                <!-- fila 1-->
                  <div class="col-md-12">



                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-6">¿Ya cancelaste esta factura?</label>
                        <div class="col-md-6">
                          <div class="input-group">

                            <?php


                              switch ($estadoFactura) {
                        

                                case 'cancelado':
                                  # code...
                                  echo   '<dt style="padding-top:8px;" class="text-success">La Factura Esta Cancelada</dt>'; 
                                  break;

                                case 'consignacion':
                                  # code...
                                  echo   '<dt style="padding-top:8px;" class="text-info">Productos en Consignación</dt>'; 
                                  break;


                                case 'credito':
                                  # code...
                                  echo   '<dt style="padding-top:8px;" class="text-danger">En Crédito</dt>'; 
                                  break;
                                
                                default:
                                  # code...
                                echo '<dt style="padding-top:8px;" class="text-danger">No Hay Datos</dt>';
                                  break;
                              }
                            ?>

                          <input type="hidden" name="estadoFactura" value="<?php echo $estadoFactura; ?>">                           
                          </div>
                        </div>
                      </div>
                    </div>




                    <div class="col-md-6" id="valorDeuda">
                      <div class="form-group">
                        <label class="control-label col-md-4">¿Cuánto Abonaste?</label>
                        <div class="col-md-8">
                          <div class="input-group">

                          <?php


                              if ($estadoFactura=='credito') {
                                # code...
                                echo '<dt style="padding-top:8px;" class="text-danger">$ '.$abonoDeuda.'</dt>
                                <input type="hidden" name="abonoDeuda" value="'.$consultaComun->normalizaciondecaracteres($abonoDeuda).'">
                                '

                                ;
                              }
                              else
                              {
                                echo '<dt style="padding-top:8px;" class="text-danger">No Aplica</dt>';
                              }
                          ?>
                            
                        </div>
                      </div>
                    </div>


                   





                  </div>
                  <!-- Fin fila 1-->
            <h2><i class="fa fa-cubes"></i>¿Cuales fueron los productos que compraste?</h2>
                  <!-- fila 2-->
                  <div class="col-md-12">
                    
                    
                <!-- LISTA  FACTURERO-->
          <div class="white-box">

            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th align="center">Nombre del Producto</th>
                    <th align="center">Valor</th>
                    <th align="center"> Unidades Paquete</th>
                    <th align="center">Iva</th>
                    <th align="center">Cantidad</th>
                    <th align="center">Total</th>
                  </tr>
                </thead>
                <tbody>
              <?php
                $t=sizeof($itemNo);
                $n=0;
                $valorTotal=0;

                while ($t>$n) {
                  # code...
                
              ?>

                  <tr>
                    <td><?php echo $itemName[$n]; ?></td>
                    <input type="hidden" name="itemName[]" value="<?php echo $itemName[$n]; ?>">
                    <td >$<?php echo number_format($price[$n]); ?></td>
                    <input type="hidden" name="price[]" value="<?php echo $price[$n]; ?>">
                    <td align="center" ><?php echo $unidades[$n]; ?></td>
                    <input type="hidden" name="unidades[]" value="<?php echo $unidades[$n]; ?>">
                    <th class="text-danger"><?php echo $iva[$n]; ?>%</th>
                    <input type="hidden" name="iva[]" value="<?php echo $iva[$n]; ?>">
                    <td><?php echo $quantity[$n]; ?></td>
                    <input type="hidden" name="quantity[]" value="<?php echo $quantity[$n]; ?>">
                    <td class="text-danger"> <b>$ <?php echo number_format($total[$n]); ?></b></td>
                    <input type="hidden" name="total[]" value="<?php echo $total[$n]; ?>">
                  </tr>
  
              <?php 
                $valorTotal=$total[$n]+$valorTotal;
                $n++;
               
            }

              ?>
                </tbody>
              </table>

          <div class="col-md-12">
            <div class="col-md-6" align="center"><button class="btn btn-block btn-danger">Quedas con una deuda de:


               $ <?php
               if ($estadoFactura=='cancelado') {
                 # Si no tiene deudas entonces el abono debe ser igual a la cantidad de la factura
                $abonoDeuda=$valorTotal;
               }
                //Imprimo el numero
                  echo number_format($valorDeuda=$valorTotal-$consultaComun->normalizaciondecaracteres($abonoDeuda));
                ?>
            </button> </div>
            <div class="col-md-6" align="center"><button class="btn btn-block btn-info">Valor total Factura: $ <?php echo number_format($valorTotal); ?></button> </div>
          </div>
            </div>
          </div>
                <!-- FIN LISTA FACTURERO-->

                  </div>


                  <!-- Fin fila 2-->

                
                  <!--/span-->
                  
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="confirmacion" value="2">
              <input type="hidden" name="valorFactura" value="<?php echo $valorTotal;?>">
              <input type="hidden" name="deudaFacturaProvedor" value="<?php echo $valorDeuda; ?>">
              <input type="hidden" name="abonoDeuda" value="<?php echo $consultaComun->normalizaciondecaracteres($abonoDeuda); ?>">
           

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