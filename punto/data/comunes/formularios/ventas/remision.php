
<form action="" name="clientForm" method="POST" data-toggle="validator">
  <div class="white-box">
    <div class="table-responsive">
  <div class="panel-heading nopaddingbottom">
    <div class="col-md-6">
      <h3> <i class="fa fa-shopping-cart"></i> Formulario de Pedido</h3>
    </div>
    <div class="col-md-offset-6">
      <h3 class="col-md-offset-7">Nro Factura: <?php echo $consultaComun->proximoNumeroFactura() ?></h3>

    </div>
    
    <div role="alert" style="" class="gritter-item-wrapper with-icon exclamation-circle send-o success mb10"></div><!-- gritter-item-wrapper -->
    <div class="panel-body nopaddingtop">

                <div class="row">
                  <div class="col-md-12">
                    
                    <div class="col-md-8">
                      <div class="form-group" id="typeaheadClientes">
                        <label class="control-label col-md-2">Nombre</label>
                        <div class="col-md-10">
                          
                            <input type="text" name="nombresApellidos" class="typeahead form-control" id="nombresApellidos" placeholder="Nombre del cliente"
                            data-error="Necesito saber como se llama el cliente" required >
                          
                        </div>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <input type="hidden" name="nuevoCliente" value="0">

                     <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-5">Identificación</label>
                        <div class="col-md-7">
                             <input type="number" min="0"  max="999999999999"id="identificacionCliente" name="identificacionCliente" class="form-control" placeholder="Identificación"  data-error="¿Y la identificación?" required>
                        </div>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>

                </div>
              </div>
        <br>
        
      <!-- SEPARADOR -->
      
      <div class="row">
                  <div class="col-md-12">
                    
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="control-label col-md-3">Dirección</label>
                        <div class="col-md-9">
                          
                            <input type="text" class="typeahead form-control"  name="direccionCliente" id="direccionCliente"  placeholder="Dirección Facturación" data-error="Necesito que me digas una dirección" required>
                          
                        </div>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>


                    

                     <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label col-md-4">Teléfonos</label>
                        <div class="col-md-8">
                          
                            <input type="text" class="form-control"  name="telefonosCliente" id="telefonosCliente"  placeholder="Teléfono">
                          
                        </div>
                      </div>
                    </div>



                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label col-md-3">Email</label>
                        <div class="col-md-9">
                          
                            <input type="email" class="form-control col-md-12"  name="emailCliente" id="emailCliente"  placeholder="Correo Cliente">
                          
                        </div>
                      </div>
                    </div>

                </div>
              </div>

          <br>
    

      <!-- SEPARADOR -->


      <div class="col-md-12">

         <div class="col-md-4">
           <div class="form-group">
            <label class="control-label col-md-3">Ciudad</label>
            <div class="col-md-9">
                          
                <input type="text" class="form-control col-md-12"  name="ciudadCliente" id="ciudadCliente"  placeholder="Correo Cliente">
                          
            </div>
          </div>
        </div>


        <div class="col-md-4">
          <label class="col-md-5 control-label">Fecha Factura</label>
            <div class="input-group">
              <input type="text" name="fechaFacturaProvedor" id="fechaFacturaProvedor" class="form-control complex-colorpicker" placeholder="mm/dd/yyyy" value="<?php echo date("m/d/Y") ?>" required>
                <span class="input-group-addon"><i class="icon-calender"></i></span> 
            </div>
          
        </div>



        <div class="col-md-4">
           <div class="form-group">
            <label class="control-label col-md-3">Tipo</label>
            <div class="col-md-9">

              <select name="tipoFactura"  class="form-control" >
                <option value="Factura">Factura</option>
                <option value="Cuenta de Cobro">Cuenta de Cobro</option>
                
              </select>
                       
            </div>
          </div>
        </div>
        
      

      </div>
<br><br>  <br>
      <!--SEPARADOR -->

      <div class="col-md-12">

         <div class="col-md-3">
           <div class="form-group">
            <label class="control-label col-md-7">Cód Vendedor</label>
            <div class="col-md-5">
                <input type="number" class="form-control col-md-12" min='1000' max='9999' name="codigoVendedor" id="codigoVendedor" value="<?php echo $datoUsuario['codigo'];  ?>"  placeholder="Quién Vendió?">
                          
            </div>
          </div>
        </div>


        <div class="col-md-4">
          <label class="col-md-4 control-label">Tipo Pago</label>
            <div class="input-group">
              <?php
                  echo $consultaComun->selectOpcionesPago(NULL);
               ?> 
            </div>
          
        </div>



        <div class="col-md-5">
           <div class="form-group">
              <div id="nroCheque" style="display: none;" >
                <input type="text" name="nroCheque" class="form-control" placeholder="Nro de Cheque">
              </div>


              <div id="incremento" style="display: none;" >
                <div class="input-group col-md-7">
                      <div class="input-group-addon">% Incremento:</div>
                      <input type="number" step="0.1" min="0" max="100" class="form-control" id="incremento" name="incremento" placeholder="0.0">
                </div>
              </div>
          </div>
        </div>
        
      

      </div>





    </div><!-- panel-body -->


    
<!-- POST DE VENTAS -->
<div class="panel-body nopaddingtop">
        <?php
          require("pos.php");
        ?>

      <div class="row">
        <div class="col-sm-12" align="center">
          <button class="btn btn-wide btn-primary btn-quirk mr5" id="save"> <i class="fa fa-save"></i>Facturame</button>
          <input type="hidden" name="tipoImpresion" value="mediaCarta">
        </div>
      </div>
      <hr>
    </div>
  </div>
  </div>
</div>





</form>