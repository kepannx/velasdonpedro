<h2> <i class="fa fa-file-text-o"></i> Factura</h2>
    <br>

        <div class='row'>
          <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
                  <th width="20%">Código Producto</th>
                  <th width="20%">¿Qué le facturarás?</th>
                  <th width="20%"><div style="text-align: center;">Valor</div>
                    
                  </th>
                  <th width="5%">Cantidad</th>
                  <th width="5%">Impuesto</th>
                  <th width="15%">Imei</th>
                  <th width="15%"><div style="text-align: center;">Total</div></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input class="case" type="checkbox"/><input type="hidden" data-type="productCode" name="itemNo[]" id="itemNo_1" class="form-control autocomplete_txt" autocomplete="off"></td>

                  <td><input type="text" data-type="skuProducto" name="sku[]" id="sku_1" class="form-control autocomplete_txt" autocomplete="off" required data-error="Al menos necesito un producto" placeholder="Código Producto">
                  <div class="help-block with-errors"></div>
                  </td>



                  <td><input type="text" data-type="productName" name="itemName[]" id="itemName_1" class="form-control autocomplete_txt changesNo" autocomplete="off" required data-error="Al menos necesito un producto" placeholder="Escribe el producto">
                  <div class="help-block with-errors"></div>
                  </td>

                  <td><input type="number" name="price[]" id="price_1" class="special changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>

                  <td><input type="number" name="quantity[]" id="quantity_1" min="0" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="1" required></td>
                  
                  <td><input type="number" name="impuesto[]" id="impuesto_1" min="0" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="0"></td>


                  <!--====  IMEIS(TEMPORAL)  ====-->
                   <td><input type="text"  name="imei[]" id="imei_1" class="form-control autocomplete_txt changesNo" autocomplete="off"  placeholder="Escribe el producto">
             
                  </td>
                  <!--====  End ITEMS (TEMPORAL)  ====-->
                  

                  <td><input type="number" readonly="" name="total[]" id="total_1" class="special totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>


        <div class='row'>
          <div class='col-md-8'>
            <div class="col-md-3">
              <button class="btn btn-success addmore" type="button"> <i class="fa fa-plus-square"></i> Agregar Mas</button>
            </div>
            <div class="col-md-3">
                <button class="btn btn-danger delete" type="button"> <i class="fa fa-minus-square"></i> Eliminar Filas</button>
            </div>
          </div>
          
          

          <!-- TOTAL COMPLETO-->
          <div class='col-md-4'>
              <label class="col-md-5">Total I.V.A</label>
              <div class="col-md-7">
                <input type="number" class="special text-danger" name="totalImpuestos" id="totalImpuestos" placeholder="Total Completo" readonly onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
            </div>
          </div>


          <!-- TOTAL COMPLETO-->
          <div class='col-md-4'>
              <label class="col-md-5">Total A Pagar:</label>
              <div class="col-md-7">
                <input type="number" class="special text-danger" name="totalFinal" id="totalAftertax" placeholder="Total Completo" readonly onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
            </div>
          </div>



          
          <input type="hidden" name="confirmacion" value="0">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
      </div>
      <br>  
      <div class="col-md-12" id="efectivoPagar">
        <div class="row">
          <div class="col-md-2"><h3>Pagará con:</h3></div>
          <div class="col-md-10">
            <input type="text"  name="efectivo" class="inputTextGrande" onkeyup="format(this)" onchange="format(this)" placeholder="¿Con Cuanto Paga?">
          </div>
        </div>
      </div>