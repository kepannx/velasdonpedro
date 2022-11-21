 <!-- row -->
			    <div class="row">
							<h2> <i class="fa fa-book"></i> Historial de Traslados</h2>
				  			<hr class="m-t-0 m-b-40">
						  		
							<!-- inicio de tablas-->
				                <?php
				                	echo $consultaProducto->historicosTraslados($datoProducto["productosConvenioId"]);
				                ?>
							<!-- fin de las tablas-->
							<!-- Fin Row-->
					

				</div>