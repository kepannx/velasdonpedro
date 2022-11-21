<div class="row">
			       	<form action="#" class="form-horizontal" name="clientForm" method="POST">
			 			<div class="form-body">
							<h3> <i class="fa fa-arrow-right"></i>  Trasladar de Bodega A Punto de Venta</h3>
				  			<hr class="m-t-0 m-b-40">
						  		

						  		<div class="col-md-6">
			                      <div class="form-group">
			                        <label class="control-label col-md-6">Quiero Trasladar de la bodega</label>
			                        <div class="col-md-6">
			                          <div class="input-group">
			                            <div class="input-group-addon"><i class="fa fa-arrow-right"></i></div>
					                  		<input type="number" name="cantidadTrasladada" min="1" max="<?php echo $consultaInventario->cantidadEnExistenciaEnBodega($datoProducto["productosConvenioId"]) ?>"  class="form-control" id="exampleInputuname"   placeholder="0" required="" title="Dime cuanto vas a trasladar al punto de venta" >
					                  		<div class="input-group-addon"><?php echo $consultaComun->stringMedidas($datoProducto["productoConvenioMedida"]) ?>	</div>
			                          </div>
			                        </div>
			                      </div>
			                   	</div>


			                   	<div class="col-md-6">
			                      <div class="form-group">
			                      	<h3 class="text-danger">de <?php echo $consultaInventario->cantidadEnExistenciaEnBodega($datoProducto["productosConvenioId"]) ?> Existentes en bodega al punto de venta</h3>
			                      </div>
			                   	</div>



			                   	<!-- BOTON -->
			         <!-- Inicio Fila 2-->
								<div class="col-md-12" align="center">
									<button type="submit" class="btn btn-success">
										<i class="fa fa-arrow-rigth"></i>
										Listo <?php echo nombreSoftware; ?>! Trasladame La Cantidad Que Indiqué  de <?php echo $datoProducto["productosConvenioNombre"]; ?>  al Punto de Venta!
									</button>  
									<input type="hidden" name="tipo" value="2">
									<input type="hidden" name="confirmacion" value="1">
									<input type="hidden" name="productoId" value="<?php echo $consultaComun->encrypt($datoProducto["productosConvenioId"], publickey); ?>">	
			                    </div>
			                    <!-- Fin Fila 2-->
			                   	<!-- FIN DEL BOTON-->

			       		</div>
			       	</form>
			    </div>