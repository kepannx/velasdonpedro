
<div class="white-box">
<form action="#" class="form-horizontal" name="clientForm" method="POST">
<?php
	$consultaComun->avisos("aviso", "Asegurate que esta sea la información que quieres editar");
?>
<div class="form-body">
			<h3> <i class="fa fa-info-circle"></i> Información Básica:</h3>
			  <hr class="m-t-0 m-b-40">
			  <!-- inicio row-->
			  <div class="row">
					<!-- fila 0 -->
					<div class="col-md-12">  
	                    <div class="col-md-4">
	                      <div class="form-group">
	                        <label class="control-label col-md-4">Producto</label>
	                        <div class="col-md-8" id="listaProductos">
	                          <div class="input-group">
	                          	<dt style="padding-top:8px;" class="text-danger"><?php echo $productosConvenioNombre; ?></dt>
                            	<input type="hidden" name="productosConvenioNombre" value="<?php echo $productosConvenioNombre; ?>">


                          		</div>
	                           
	                         
	                        </div>
	                      </div>
	                    </div>
		
	                  	<div class="col-md-4">
	                      <div class="form-group">
	                        <label class="control-label col-md-6">¿A cómo lo vendes?</label>
	                        <!--Check Aplica -->
	                        <div class="col-md-6">
	                        <dt style="padding-top:8px;" class="text-danger"> $ <?php echo $inventarioConvenioValorCompra; ?></dt>
                            <input type="hidden" name="inventarioConvenioValorCompra" value="<?php echo $inventarioConvenioValorCompra; ?>">
	                        </div>
	                        <!-- Fin check no aplica-->
	                      </div>
                    	</div>



	                  <div class="col-md-4">
	                      <div class="form-group">
	                        <label class="control-label col-md-4">Alértame A Los </label>
	                        <div class="col-md-8">
	                        	<div class="input-group">
			                        <dt style="padding-top:8px;" class="text-danger">  <i class="fa fa-bell"></i> <?php echo $productosConvenioMinimo." ".$consultaComun->stringMedidas($inventarioConvenioMedida[0]); ?> </dt>
		                            <input type="hidden" name="productosConvenioMinimo" value="<?php echo $productosConvenioMinimo; ?>">
                           		</div>
	                        </div>
	                      </div>
	                    </div>
                  	</div>
					<!-- Fin Fila 0-->

					<!-- Inicio Fila 1 -->
					 
					<div class="col-md-12">
						<div class="col-md-4">
	                      <div class="form-group">
	                        <label class="control-label col-md-4">Medida</label>
	                        <div class="col-md-6">  <!-- inventarioConvenioMedida -->
	                          <div class="input-group">
			                        <dt style="padding-top:8px;" class="text-danger">  <?php echo $consultaComun->stringMedidas($inventarioConvenioMedida[0]); ?> </dt>
		                            <input type="hidden" name="inventarioConvenioMedida" value="<?php echo $inventarioConvenioMedida[0]; ?>">
                           		</div>
	                        </div>
	                      </div>
	                   	</div>


	                   
                    </div>
                    <!-- Fin Fila 1-->



                    <!-- Inicio Fila 2-->
					<div class="col-md-12" align="center">
						<button type="submit" class="btn btn-success">
							<i class="fa fa-save"></i>
							¿Quieres Guardar Los Cambios Que Le Harás a La 	Información Básica de <?php echo $datoProducto["productosConvenioNombre"]; ?> ?
						</button>  
						<input type="hidden" name="tipo" value="1">
						<input type="hidden" name="confirmacion" value="2">
						<input type="hidden" name="productoId" value="<?php echo $consultaComun->encrypt($datoProducto["productosConvenioId"], publickey); ?>">	
                    </div>
                    <!-- Fin Fila 2-->
				</div>	
			</div>
			  <!-- Fin  row-->
		</div>
</form>

</div>