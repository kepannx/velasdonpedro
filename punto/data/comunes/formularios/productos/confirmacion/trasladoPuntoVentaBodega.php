<div class="white-box">
<?php
	$consultaComun->avisos("aviso", "Estas seguro que esta es la cantidad que quieres trasladar a la bodega?");
?>
<div class="row">
			       	<form action="#" class="form-horizontal" name="clientForm" method="POST">
			 			<div class="form-body">
							<h3> <i class="fa fa-arrow-left"></i>  Trasladar Del Punto de Venta A Bodega</h3>
				  			<hr class="m-t-0 m-b-40">
						  		

						  		<div class="col-md-12">
			                      <div class="form-group" align="center">
			                        <h1>Quiero Trasladar  Del Punto De Venta</h1>
			                        <div class="col-md-12">
			                          <div class="input-group">
			                            <h1 class="text-danger"><?php echo $cantidadTrasladada; ?> Existentes en Punto De Venta A Bodega</h1>
			                            <input type="hidden" name="cantidadTrasladada" value="<?php echo $cantidadTrasladada; ?>">
			                          </div>
			                        </div>
			                      </div>
			                   	</div>





			                   	<!-- BOTON -->
			         <!-- Inicio Fila 2-->
								<div class="col-md-12" align="center">
									<button type="submit" class="btn btn-success">
										<i class="fa fa-arrow-rigth"></i>
										Listo <?php echo nombreSoftware; ?>! Trasladame La Cantidad Que Indiqué  de <?php echo $datoProducto["productosConvenioNombre"]; ?>  al Punto de Venta!
									</button>  
									<input type="hidden" name="tipo" value="3">
									<input type="hidden" name="confirmacion" value="2">
									<input type="hidden" name="productoId" value="<?php echo $consultaComun->encrypt($datoProducto["productosConvenioId"], publickey); ?>">	
			                    </div>
			                    <!-- Fin Fila 2-->
			                   	<!-- FIN DEL BOTON-->

			       		</div>
			       	</form>
			    </div>

			</div>