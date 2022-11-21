<div class="white-box">
  <div class="table-responsive">
	<h2> <i class="fa fa-list"></i> Productos Facturados</h2>

		
		<?php
				$consultaFacturas->productosFacturadosFacturaProvedor($datoFactura["idfacturaProvedor"]);
		?>
		

		<!-- listado de los abonos hechos a la factura-->
		<div class="col-md-6">
		<?php
			$consultaComun->listaAbonosFacturaProvedor($datoFactura['idfacturaProvedor']);
		?>

			
		</div>
		<!--Fin del listado de los abonos hechos a la factura -->
		<div class="col-md-6">
	
			<div class="row sales-report">
				<?php if ($datoFactura["estadoFactura"]=='credito') {
					# code...
				 ?>
			  <div class="col-md-6 col-sm-6 col-xs-6 ">
                <h2 class="text-left">Deuda</h2>
                <h1 class="text-left text-danger m-t-20">$<?php echo number_format($datoFactura["deudaFacturaProvedor"]); ?></h1>
              </div>
              <?php } ?>


              <div class="<?php if($datoFactura["estadoFactura"]=='credito')

              			{ echo "col-md-6 col-sm-6 col-xs-6"; }
              			else { echo 'col-md-12 col-sm-12 col-xs-12'; } ?> ">
                <h2 class="text-right">Total Factura</h2>
                <h1 class="text-right text-success m-t-20">$<?php echo number_format($datoFactura["valorFacturaProvedor"]); ?></h1>
              </div>
              
            </div>
		</div>
	</div>
</div>