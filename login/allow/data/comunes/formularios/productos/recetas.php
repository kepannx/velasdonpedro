<div class="row">
        <div class="col-md-12">
          <div class="panel panel-success">
            <div class="panel-heading" align="center"><i class="ti-hand-point-right"></i>Si tienes productos que son fabricados en la cocina y necesitas llevar un inventario mas preciso de los insumos que te gastas fabricandolos, aquí es el lugar donde debes estar, solo debes crear la receta para la fabricación de tu producto y cuando se venda yo deduciré los insumos del inventario automáticamente</div>
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
                            <div class="input-group-addon"><i class="ti-shopping-cart"></i></div>
                            <input type="text" name="recetasConvenioNombre" id="recetasConvenioNombre" class="typeahead form-control" required placeholder="Cómo se llama el producto?">
                          </div>
                        </div>
                      </div>
                    </div>


                     <div class="col-md-5">
                      <div class="form-group">
                        <label class="control-label col-md-3">Valor Venta</label>
                        <div class="col-md-9">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="ti-money"></i></div>
                           
                            <input type="text" name="recetasConvenioValor" class="form-control" id="recetasConvenioValor"  onkeyup="format(this)" onchange="format(this)" placeholder="En cuánto lo vas a vender?" required="" >
                          </div>
                        </div>
                      </div>
                    </div>



                  <!-- Fin fila 0-->


                <!-- fila 1  Tabla de productos que aplican a receta -->
                   <?php
                      require("../../data/comunes/formularios/productos/itemsRecetas.php");
                    ?>
      
                <!-- Fin  fila 1 Tabla de productos que aplican a receta-->
                 
                </div>
                  <!--/span-->
                  
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="confirmacion" value="1">
              <?php
                if(!isset($_SESSION['sesionControl'])) {
                    $_SESSION['sesionControl'] = time();;
                }

              ?>

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