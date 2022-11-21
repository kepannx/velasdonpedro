<div class="col-md-12">
	<div class="col-md-4">
		<div class="form-group">
      		<label>Cómo Llamarás Al Producto o Servicio</label>
      		<div class="input-group" id="productosServicios">
	        	<div class="input-group-addon">
	        		<i class="fa fa-fort-awesome"></i>
	        	</div>

	        	<input type="text" class="typeahead form-control" id="nombreProductosServicios" placeholder="Dime como llamarás a este punto de venta" value="<?php echo $datosProductoServicio['nombreProductosServicios']; ?>" data-error="Necesito que me digas el nombre del producto" max="100" required>
	      	</div>
    		<div class="help-block with-errors"></div>
  		</div>
	</div>


	<div class="col-md-3" id="capaSerializada">
		<div class="form-group">
	      	<label>Tipo</label>
	      	<div class="input-group col-md-12">
		        <select id="tipoProductoServicio" class="form-control " >
		        		<?php
	                	echo $objHtm->selectTipoProductoServicio($datosProductoServicio['tipoProductoServicio']);
	            		?>
		        </select>
		        	
		      </div>
	  	</div>
	</div>



	<div id="capaServicios">
		<div class="col-md-2" >
			<div class="form-group">
	      		<label>Marca</label>
					
	      		<div class="input-group col-md-12" id="marcas">
	      			<div class="input-group-addon">
		        		©	
		        	</div>
		        	<input type="text" id="marca" max="50" class="typeahead form-control" value="<?php echo $datosProductoServicio['marca'];  ?>" placeholder="Marca">	        
		      	</div>
	    		
	  		</div>
		</div>

		<div  class="col-md-1">
			<div class="form-group">
	      		<label>Serializado?</label>
	      		<div class="input-group">
		        <?php
	                echo $objHtm->checkProductoSerializado($datosProductoServicio['serializacion']);
	            ?>       
		      	</div>
	    		
	  		</div>
		</div>

		<div class="col-md-2">

			<div id="serializado">
				
				<?php
					if ($datosProductoServicio['serializacion']=='si') {
						# code...
						 $objHtm->optionValuesSeriales($datosProductoServicio['serial'], $datosProductoServicio['imei'], $datosProductoServicio['otroTipoSerial']);
					}
				?>
			</div>
		</div>
	</div>


</div>

<!-- Segundo Renglón -->

<div class="col-md-12" id="segundoRenglonCapaServicios" >
	<div class="col-md-4">
		<div class="form-group">
      		<label>Categoría</label>
      		<div class="input-group col-md-12">
	        	<select id="categoria" class="form-control"  data-error="Debes asignarle una categoría" required >
	        
	        		<option>Selecciona Una Categoría</option>
	        		<?php $consultaComun->selectCategorias($consultaComun->encrypt($datosProductoServicio['categoria'], publickey)); ?>
	        	</select>
	        	<div class="help-block with-errors"></div>
	      	</div>
    		
  		</div>
	</div>



	<div class="col-md-4">
		<div class="form-group">
      		<label>SubCategoría</label>
      		<?php
      			if ($datosProductoServicio['subCategoria']==NULL || $datosProductoServicio['subCategoria']==0) {
      				# code...
      				echo '<div class="input-group col-md-12"  id="subCat"></div>';
      			}
      			else{
      				echo '<div class="input-group col-md-12"  id="subCat">
							'.$consulta->selectSubCategorias($consulta->encrypt($datosProductoServicio['categoria'], publickey), $consulta->encrypt($datosProductoServicio['subCategoria'], publickey)).'
      					</div>';
      			}
      		 ?>
      		
  		</div>
	</div>


	<div class="col-md-4">
		<div class="form-group">
      		<label>Codigo/SKU</label>
      		<div class="input-group col-md-12">
      			<div class="input-group-addon">
	        		<i class="fa  fa-barcode"></i>
	        	</div>
	        	<input type="text" id="sku" class="form-control" placeholder="Con cuál código lo identificarás?" data-error="Necesito que le des un código para identificarlo" value="<?php echo $datosProductoServicio['sku']; ?>" required>	        
	      	</div>
    		<div class="help-block with-errors"></div>
  		</div>
	</div>
</div>
<!-- Fin Segundo Renglón -->

<!-- Tercer Renglón -->
<div class="col-md-12">
	<div class="col-md-3" id="valorFinalServicio">
		<div class="form-group">
      		<label>Valor Final</label>
      		<div class="input-group col-md-12">
	        	<div class="input-group-addon">
	        		<i class="fa  fa-dollar"></i>
	        	</div>
	        	<input type="text" class="form-control " id="valorVentaUnidad" placeholder="En cuánto lo venderás?" value="<?php echo $datosProductoServicio['valorVentaUnidad'] ?>" data-error="Necesito que me digas en cuanto lo venderás"  onkeyup="format(this)" onchange="format(this)"  required>
	      	</div>
    		<div class="help-block with-errors"></div>
  		</div>
	</div>

	<div  id="tercerRenglonCapaServicios">
		<div class="col-md-3">
			<div class="form-group">
	      		<label>Valor Por Mayor</label>
	      		<div class="input-group">
		        	<div class="input-group-addon">
		        		<i class="fa  fa-dollar"></i>
		        	</div>
		        	<input type="text" class="form-control" id="valorVentaPorMayor" placeholder="Valor a Mayoristas" value="<?php echo $datosProductoServicio['valorVentaPorMayor'] ?>"  onkeyup="format(this)" onchange="format(this)" >
		      	</div>
	    		<div class="help-block with-errors"></div>
	  		</div>
		</div>



		<div class="col-md-3">
			<div class="form-group">
	      		<label>Mínimos Globales</label>
	      		<div class="input-group">
		        	<div class="input-group-addon">
		        		<i class="fa fa-bell"></i>
		        	</div>
		        	<input type="number" class="form-control" id="cantidadMinimaGlobal" placeholder="Mínimos en la empresa" min="0" value="<?php echo $datosProductoServicio['cantidadMinimaGlobal'] ?>">
		      	</div>
	  		</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
	      		<label>Mínimos En Punto de Venta</label>
	      		<div class="input-group">
		        	<div class="input-group-addon">
		        		<i class="fa fa-bell"></i>
		        	</div>
		        	<input type="number" class="form-control" id="cantidadMinimaPuntos" placeholder="Minimos en los puntos" min="0" value="<?php echo $datosProductoServicio['cantidadMinimaPuntos'] ?>">
		      	</div>
	  		</div>
		</div>
	</div>
	<div class="col-md-12">
		
		<div class="col-md-6">
			<label>Ventas Cruzadas</label>

			
			<div class="input-group">
				<select id='ventaCruzada' multiple='multiple'>
                  <?php $consultaComun->selectProductosServiciosCruzados($datosProductoServicio['ventaCruzada']); ?>
                </select>
			</div>
			
		</div>
		<div class="col-md-6">
			<div class="col-md-6">
				<label>Mostrar En Existencia?</label>
				<div class="input-group">
					<?php echo $objHtm->checkExistencia($datosProductoServicio['retiroTemporal']); ?>
				</div>
			</div>


			<div class="col-md-6">
				<label>Mostrar En Pagina Web?</label>
				<div class="input-group">
					<?php echo $objHtm->checkMostrarWeb(); ?>
				</div>
			</div>
		</div>	
   	</div>
</div>
<!-- Fin Tercer Renglón -->

