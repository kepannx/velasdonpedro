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
              <input type="number"  class="form-control" id="impuesto" min="0" max="100" step="0.1" value="0" placeholder="Impuesto">
            </div>
    </div>
    <div id="volumenes">
      <div class="col-sm-12"><label>Cantidad</label><div class="input-group"><div class="input-group-addon"><i class="fa fa fa-shopping-basket"></i></div><input type="number" class="form-control" id="cantidades" min="0" max="100000"  placeholder="Cantidades"></div></div>
    </div>
    <div id="precios"></div>
    <div id="categorias"></div>
    <div id="subCategoria"></div>
    <div id="volumenesSeriales"></div>
    
    
    <div class="col-md-12" align="center">
      <br><br>
      <button type="button" id="addArticulo" class="btn btn-info" > <i class="fa fa-plus-circle"></i> Agregar A La Factura </button>
    </div>



  </div>


  
  <a href="#" onclick="loadPrefactura()"> <i class="fa fa-refresh"></i> Refrescar Prefactura</a>
  <input type="hidden" id="idproductosServicios" value="">

  <!-- Listado Ingresado -->
  <div class="col-md-8 col-sm-12">
  <!-- tabla-->
  <div class="col-md-12 table-responsive" id="listadoProductos">
  

  </div>
  <!-- fin tabla-->

    
  </div>

</div>