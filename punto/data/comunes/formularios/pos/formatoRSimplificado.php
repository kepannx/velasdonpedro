<table id="tablaSimplificado" class="table table-striped">
                  <thead>
                    <tr>
                      <th width="10px"><i class="fa fa-trash"></i></th>
                      <th width="100px"><div style="text-align: center">Código</div></th>
                      <th ><div style="text-align: center">Item</div></th>
                      <th width="180px"><div style="text-align: center">Valor</div></th>
                      <th width="20px"><div style="text-align: center">Cantidad</div></th>
                      <th width="150px"><div style="text-align: center">Total</div></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      
                      <td>
                        <input type="checkbox"  id="checkItem">
                        <input type="hidden" id="idProducto_1" data-type="idProducto" value="">
                      </td>
                      

                      <td>
                        <input type="text" id="sku_1"  class="form-control autocompletar" data-type="sku" placeholder="SKU"  autocomplete="off">
                      </td>
                      
                      <td>
                         <input type="text" id="productoServicio_1" class="form-control autocompletarItem" data-type="productoServicio" placeholder="Qué Llevará El Cliente?" autocomplete="off">
                      </td>
                      <td>
                    <div class="input-group">
                      <input type="text"  id="valorItem_1"  value="" class="form-control changesNo valorBruto" readonly >
                      <span class="input-group-addon">
                        DS
                        <input type="checkbox" class="changesNo" id="porMayor_1">
                      </span>
                      </div>
                      </td>

                      <td>
                        <input type="number" id="cantidad_1" min="1" value="1" class="form-control changesNo cantidades">
                      </td>
                      <td align="center"><input class="subtotal inputNone"  id="subTotal_1" readonly>
                      
                      </td>


                    </tr>
                  </tbody>
                </table>
                <script src="../../js/acciones/itemsFacturacionSimplificado.js"></script>