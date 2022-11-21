<div class="col-md-12">
	<!-- Formulario de Ingreso -->
	<div class="col-md-4 col-sm-12">
		<h4 align="center"> <i class="fa fa-sign-in"></i> Qué Le Ingresarás A La Factura?</h4>
		<div class="col-md-12">
	        <label>Codigo/SKU</label>
	          <div class="input-group"  id="skuCodigo">
	            <div class="input-group-addon">
	              <i class="fa fa-barcode"></i>
	            </div>
	            <input type="text" class="typeahead form-control" id="sku" placeholder="Qué Código Tiene?">
	          </div>
	        <div class="help-block with-errors"></div>
		</div>

		
		<div class="col-md-12">
	        <label>Cómo Llamarás Al Producto o Servicio</label>
      		<div class="input-group" id="productosServicios">
	        	<div class="input-group-addon">
	        		<i class="fa fa-fort-awesome"></i>
	        	</div>


	        	<input type="text" class="form-control" id="nombreProductosServicios" placeholder="Dime como llamarás a este punto de venta"  data-error="Necesito que me digas el nombre del producto" max="100" required>
	      	</div>
    		<div class="help-block with-errors"></div>
		</div>




		<div class="col-md-7 col-sm-12">
	        <label>Costó Unidad?</label>
	          <div class="input-group">
	            <div class="input-group-addon">
	              <i class="fa fa-dollar"></i>
	            </div>
	            <input type="text" class="form-control" id="valorUnidad" placeholder="Costo Unidad" onkeyup="format(this)" onchange="format(this)"  >
	          </div>
	        <div class="help-block with-errors"></div>
		</div>


		<div class="col-md-5 col-sm-12">
	        <label>Iva</label>
	          <div class="input-group">
	            <div class="input-group-addon">
	              <i class="fa fa-percent"></i>
	            </div>
	            <input type="number"  class="form-control" id="impuesto" min="0" max="100" step="0.1" placeholder="Impuesto">
	          </div>
		</div>
		<div id="volumenes">
			<div class="col-sm-12"><label>Cantidad</label><div class="input-group"><div class="input-group-addon"><i class="fa fa fa-shopping-basket"></i></div><input type="number" class="form-control" id="cantidades" min="0" max="100000"  placeholder="Cantidades"></div></div>
		</div>
		<div id="precios"></div>
		<div id="volumenesSeriales"></div>
		
		
		<div class="col-md-12" align="center">
			<br><br>
			<button type="button" id="addArticulo" class="btn btn-info"> <i class="fa fa-plus-circle"></i> Agregar A La Factura </button>
		</div>



	</div>


	


	<input type="hidden" id="idproductosServicios" value="">

	<!-- Listado Ingresado -->
	<div class="col-md-8 col-sm-12">
		<h4 align="center"> <i class="fa fa-sort-amount-asc"></i> Esto Es Lo Que Registraré</h4>
	<!-- tabla-->
	<div class="col-md-12 table-responsive">
	
		<table id="demo-foo-row-toggler" class="table toggle-circle table-hover">
              <thead>
                <tr>
                  <th ><div style="text-align: center"> Sku</div></th>
                  <th> Producto </th>
                  <th> <div style="text-align: center">Costo Unidad </div></th>
                  <th> <div style="text-align: center">Unidades </div></th>
                  <th> <div style="text-align: center">Valor Neto</div></th>
                  <th> <div style="text-align: center">Valor Total</div></th>
                  <th data-hide="" data-toggle="true"><div style="text-align: center">Serial</div></th>
                  <th data-hide="all" > </th>
                </tr>
              </thead>
              <tbody id="listadoProductos">
        
              </tbody>
            </table> 
     	<div class="col-md-12">
                <div class="pull-right m-t-30 text-right">
                  <p class="text-green">SubTotal: <span id="subTotal">0</span></p>
                  <p class="text-danger">Impuestos : <span id="totalImpuestos"></span>  </p>
                  <hr>
                  <h3 class="text-success"><b>Total :</b> <span id="totalFinal"></span></h3>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div align="right">
                  <button class="btn btn-success" id="saveInventario" > <i class="fa fa-save"></i> Registra Ya El Inventario  </button>

                  
                </div>
              </div>
	</div>
	<!-- fin tabla-->

		
	</div>

</div>
<div class="col-md-12">
	<hr>
</div>