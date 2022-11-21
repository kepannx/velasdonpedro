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
              <input class="inputs typeahead form-control" type="text" id="sku" placeholder="dame el serial o codigo"  autofocus="" />
            </div>
          <div class="help-block with-errors"></div>
    </div>

    
    <div class="col-md-12">
          <div class="input-group" id="productosServicios">
            <div id="nombreProductosServicios"></div>
          </div>
    </div>



    <div id="costo"></div>

    <div class="col-md-12 col-sm-12">

        <div id="taxes">
       <input type="hidden" id="impuesto" value="0"> 
         
          
        </div><!--INGRESO LOS IMPUESTOS -->   
    </div>


    <div class="col-md-12" align="center">
      <button type="button" id="addArticulo" class="btn btn-info"> <i class="fa fa-plus-circle"></i> Agregar A La Factura </button>
    </div>



  </div>


  


  <input type="hidden" id="idproductosServicios" value="">

  <!-- Listado Ingresado -->
  <div class="col-md-8 col-sm-12">
    <h4 align="center"> <i class="fa fa-sort-amount-asc"></i> Esto Es Lo Que Registraré</h4>
  <!-- tabla-->

  

  <div class="col-md-12 table-responsive">

    <!-- LISTADO DE PRODUCTOS -->


    <div id="preFacturacion"></div>
    

    <!-- FIN LISTADO DE PRODUCTOS -->
      <div class="col-md-12">
    
        <!--==== RESULTADOS  ====-->
        
        <!--==== TIPOS DE PAGO  ====-->
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


                    </div>
                </div>
            <div id="opcionEfectivo"></div>
            <div id="opcionDebito"></div>
            <div id="opcionCredito"></div>
            <div id="opcionCheque"></div>
            <div id="opcionServicredito"></div>

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


