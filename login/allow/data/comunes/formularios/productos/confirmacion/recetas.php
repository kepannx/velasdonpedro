<div class="row">
        <div class="col-md-12">
          <div class="panel panel-success">
            <div class="panel-heading" align="center"><i class="ti-hand-point-right"></i>Si tienes productos que son fabricados en la cocina y necesitas llevar un INVENTARIOS mas preciso de los insumos que te gastas fabricandolos, aquí es el lugar donde debes estar, solo debes crear la receta para la fabricación de tu producto y cuando se venda yo deduciré los insumos del INVENTARIOS automáticamente</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
            <form action="#" class="form-horizontal" name="clientForm" method="POST">
              <div class="form-body">
                <h3 class="box-title">INFORMACIÓN DE LA  RECETA</h3>
                <hr class="m-t-0 m-b-40">
                 
                <div class="row">

                 <!-- fila 0-->
                   <div class="col-md-7">
                      <div class="form-group">
                        <label class="control-label col-md-2">Producto</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <dt style="padding-top:8px;" class="text-danger"><?php echo $recetasConvenioNombre; ?></dt>
                            <input type="hidden" name="recetasConvenioNombre" value="<?php echo $recetasConvenioNombre; ?>">
                          </div>
                        </div>
                      </div>
                    </div>


                     <div class="col-md-5">
                      <div class="form-group">
                        <label class="control-label col-md-3">Valor Venta</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <dt style="padding-top:8px;" class="text-danger">$ <?php echo $recetasConvenioValor; ?></dt>
                            <input type="hidden" name="recetasConvenioValor" value="<?php echo $recetasConvenioValor; ?>">
                          </div>
                        </div>
                      </div>
                    </div>


                  <!-- Fin fila 0-->


                <!-- fila 1  Tabla de productos que aplican a receta -->

                  <div class="row">
                    <div class="col-lg-12">
                      <div class="white-box">
                      
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Lo Que Tendrá</th>
                                <th>La Cantidad</th>
                                <th>La Medida</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                            $t=sizeof($itemNo);
                            $control=0;
                            while ($t>$control) {
                              # code...
                              echo '<tr>
                                <td class="text-danger">'.$itemName[$control].'</td>
                                <input type="hidden" name="itemName[]" value="'.$itemName[$control].'">
                                <td align="left">'.$cantidad[$control].'</td>
                                <input type="hidden" name="cantidad[]" value="'.$cantidad[$control].'">
                                <td><span class="text-muted"><i class="fa fa-clock-o"></i> '.$medida[$control].'</span> </td>
                                <input type="hidden" name="itemNo[]" value="'.$itemNo[$control].'">
                                <input type="hidden" name="medida[]" value="'.$medida[$control].'">
                              </tr>';
                              $control++;
                            }
                            ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                   <?php
                      //require("../../../data/comunes/formularios/productos/itemsRecetas.php");
                    ?>
      
                <!-- Fin  fila 1 Tabla de productos que aplican a receta-->
                 
                </div>
                  <!--/span-->
                  
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="confirmacion" value="2">
              



                <!--/row-->
              </div>
            
            <div class="col-md-12">
              <div class="form-actions" align="center">
                <div class="row">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Listo! Guarda esta receta!</button>
                    </div>
              </div>
            </div>    
          </form>
              </div>
            </div>
          </div>
        </div>
      </div>