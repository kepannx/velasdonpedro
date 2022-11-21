<div class="panel-body">
                         <h2><i class="fa fa-cubes"></i> Datos De Bodegaje y Administrativos</h2>
                         
                        <div class='row'>
          <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
            <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
              <th width="28%"><div style="width: 100%; text-align: center;">Nombre del Producto</th>
              <th width="15%"><div style="width: 100%; text-align: center;">Valor</div></th>
              <th width="15%"><div style="width: 100%; text-align: center;">Unidades Paquete</div></th>
              <th width="10%"><div style="width: 100%; text-align: center;">Iva</div></th>
              <th width="10%"><div style="width: 100%; text-align: center;">Cantidad</div></th>
              <th width="15%"><div style="width: 100%; text-align: center;">Total</div></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              
              <td>
                <input class="case" type="checkbox"/>
                <input type="hidden" data-type="productCode" name="itemNo[]" id="itemNo_1" class="form-control autocomplete_txt" autocomplete="off" required>
              </td>

              <td>
                
              <input type="text" data-type="productName" name="itemName[]" id="itemName_1" class="form-control autocomplete_txt" autocomplete="off" required></td>
              

              <td><input type="text" name="price[]" id="price_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" required></td>

               <td><input type="text" name="unidades[]" id="unidades_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" required></td>

              <td><input type="number" name="iva[]" id="iva_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" required></td>
              


              <td><input type="text" name="quantity[]" id="quantity_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" required=""></td>


              

              <td><input type="number" name="total[]" id="total_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
            </tr>
          </tbody>
        </table>
          </div>
        </div>


        <div class='row'>
          <div class='col-md-6'>
            <div class="col-md-6">
              <button class="btn btn-success addmore" type="button"> <i class="fa fa-plus-square"></i> Agregar Mas Productos</button>
            </div>
            <div class="col-md-6">
              <button class="btn btn-danger delete" type="button"> <i class="fa fa-minus-square"></i> Eliminar La Fila</button>
            </div>
            <div class='col-md-12'>
              <section align="justify">
                  <h6 class="text-muted" style="line-height: 20px;"><i class="fa fa-bullhorn"></i> Si necesitas agregar una nueva fila a la factura, solo debes hacer clic en  el botón verde "<i class="fa  fa fa-plus-square"></i> Agregar Mas Productos", pero si por el contrario, necesitas eliminar una  fila,  debes hacer clic sobre el ckeckbox de las filas que quieres eliminar (<i class="fa  fa-check-square-o"></i>) y luego de seleccionarlas, darle clic en el botón "<i class="fa fa-minus-square"> </i> Eliminar La Fila"</h6>  
              </section>  
            </div>
        
          </div>
        
        <div class='col-xs-6'>
          <div class="form-group">
            <label>Subtotal: &nbsp;</label>
            <div class="input-group">
              <div class="input-group-addon">$</div>
              <input type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
            </div>
          </div>


          
          <div class="form-group">
            <label>Total: &nbsp;</label>
            <div class="input-group">
              <div class="input-group-addon">$</div>
              <input type="number" class="form-control" name="totalFinal" id="totalAftertax" placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
            </div>
          </div>
          
          <input type="hidden" name="confirmacion" value="1">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
      </div>
        </div>
        
                    <input type="hidden" name="hash" value="<?php fechaActual ?>">

                    </div>
