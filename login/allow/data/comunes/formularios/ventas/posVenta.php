<?php
if (!isset($_SESSION['tokenPrefactura'])) {
  $_SESSION['tokenPrefactura']=strtotime(date('Y-m-d H:i:s')).''.$validar->decrypt($_SESSION['datos'],key);
}else{
  $_SESSION['tokenPrefactura']=0;
  unset($_SESSION['tokenPrefactura']); //Destruyo la sesion
  session_destroy($_SESSION['tokenPrefactura']);
  $_SESSION['tokenPrefactura']=strtotime(date('Y-m-d H:i:s')).''.$validar->decrypt($_SESSION['datos'],key);//Creo una nueva
} 
?>


<div class="col-md-12" id="noPrint">
<input type="hidden" id="tokenPrefactura"  value="<?php echo $_SESSION['tokenPrefactura'];  ?>">

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
          <label>Cuál es el nombre del producto?</label>
          <div class="input-group" id="productosServicios">
            <div class="input-group-addon">
              <i class="fa fa-fort-awesome"></i>
            </div>
            <input type="text" class="form-control" id="nombreProductosServicios" placeholder="Nombre del producto"  data-error="Necesito que me digas el nombre del producto" max="100" required>
          </div>
        <div class="help-block with-errors"></div>
    </div>



    <div class="col-md-7 col-m-12">
          <label>Costó Unidad?</label>
            <div class="input-group">

              <div class="input-group-addon" id="alertacosto">
                  <i class="fa fa-dollar"></i>
              </div>
              <input type="text" class="form-control" id="valorUnidad" placeholder="Costo Unidad" onkeyup="format(this)" onchange="format(this)"  >
            </div>
          <div class="help-block with-errors"></div>
    </div>


  
    <?php

    //SI ES REGIMEN COMÚN
    if ($datoUsuario["regimenTributario"]=='regimen comun') {
      # code...
    ?>
    <div class="col-md-5 col-sm-12">
          <label>Iva</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-percent"></i>
              </div>
              <input type="number"  class="form-control" id="impuesto" min="0" max="100" step="0.1" value="19"  placeholder="Impuesto">
            </div>
    </div>

  <?php }else{/*otros regimenes no aplica iva */ echo '<input type="hidden" id="impuesto" value="0">';} ?>
    <div id="volumenes">
      <div class="col-sm-12"><label>Cantidad</label><div class="input-group"><div class="input-group-addon"><i class="fa fa fa-shopping-basket"></i></div><input type="number" class="form-control" id="cantidades" min="1" max="100000"  placeholder="Cantidades"></div></div>
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
  
  
    <div id="preFacturacion"></div>
    
      <div class="col-md-12">
    
        <!--==== RESULTADOS  ====-->
        
                
                <div class="clearfix"></div>
                <hr>
                 <div class="col-md-12">
                <div class="form-group">
                    <label >Cómo Lo Pagará?</label>
                    
                    <div class="checkbox checkbox-circle">
                      <div class="col-md-3">
                        <input id="efectivo" type="checkbox">
                        <label for="efectivo">Efectivo</label>
                      </div>

                      <div class="col-md-3">
                        <input id="debito" type="checkbox">
                        <label for="debito">T Débito</label>
                      </div>
                      
                      <div class="col-md-3">
                        <input id="credito" type="checkbox">
                        <label for="credito">T Crédito</label>
                      </div>
                      
                      <div class="col-md-3">
                        <input id="cheque" type="checkbox">
                        <label for="cheque">Cheque</label>
                      </div>

                      <div class="col-md-3">
                        <input id="servicredito" type="checkbox">
                        <label for="servicredito">ServiCrédito</label>
                      </div>

                      <div class="col-md-3">
                        <input id="epm" type="checkbox">
                        <label for="epm">EPM</label>
                      </div>


                    </div>
                </div>
            <div id="opcionEfectivo"></div>
            <div id="opcionDebito"></div>
            <div id="opcionCredito"></div>
            <div id="opcionCheque"></div>
            <div id="opcionServicredito"></div>
            <div id="opcionEpm"></div>

              </div>
              <!--====  End of METODOS DE PAGO  ====-->
                <div align="right">
                  <button class="btn btn-success" id="saveFactura" style="display:none"   data-toggle="modal" data-target="#confirmacionFacturVenta" > <i class="fa fa-save"></i> Registra Ya La Factura </button>  
                </div>

    <!--====  End of RESULTADOS  ====-->


    
      </div>
  </div>
  <!-- fin tabla-->

    
  </div>
          <!--====  End of METODOS DE PAGO  ====-->
              
             
</div>


