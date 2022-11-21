<div class="col-md-12" id="noPrint">
  <!-- Formulario de Ingreso -->
  <div class="col-md-4 col-sm-12">
    <h4 align="center"> <i class="fa fa-sign-in"></i> Qué Le Ingresarás A La Factura?</h4>


    <div class="col-md-12">
          <label>Codigo, Serial o Imei</label>
            <div class="input-group"  id="nombreProducto">
              <div class="input-group-addon">
                <i class="fa fa-barcode"></i>
              </div>
              <input type="text" class="typeahead form-control" id="sku" placeholder="Qué Código Tiene?">
            <input type="hidden" id="token" value="<?php echo strtotime(date('Y-m-d H:i:s')); ?>">
            </div>
          <div class="help-block with-errors"></div>
    </div>

    <div id="nmProductoServicio"></div>
  



    <div id="volumenes">
      
    </div>
    <div id="volumenesSeriales"></div>
    
    
    <div class="col-md-12" align="center">
      <br><br>
      <button type="button" id="addArticulo" class="btn btn-info"> <i class="fa fa-plus-circle"></i> Agregar A La Factura </button>
    </div>
  </div>
  <input type="hidden" id="idproductosServicios" value="">

  <!-- Listado Ingresado -->
  <div class="col-md-8 col-sm-12">
    <h4 align="center"> <i class="fa fa-sort-amount-asc"></i> Esto Es Lo Que Trasladarás</h4>
  <!-- tabla-->
  <div class="col-md-12 table-responsive">
    <div id="listadoProductos"></div>

  </div>
  <!-- fin tabla-->

    
  </div>
          <!--====  End of METODOS DE PAGO  ====-->
              
             
</div>


