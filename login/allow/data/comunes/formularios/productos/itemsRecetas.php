<div class="panel-body">
                         <h2>¿<i class="fa fa-beer"></i>Que Va a Llevar Esta Deliciosa  Receta? </h2>
                         
                        <div class='row'>
          <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
            <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
              <th width="38%">Lo que tendrá</th>
              <th width="5%">La Cantidad</th>
              <th width="15%">La Medida</th>
              
            </tr>
          </thead>
          <tbody>
            <tr>
              
              <td><input class="case" type="checkbox"/><input type="hidden" data-type="productCode" name="itemNo[]" id="itemNo_1" class="form-control autocomplete_txt" autocomplete="off"></td>

              <td><input type="text" data-type="productName" name="itemName[]" id="itemName_1" class="form-control autocomplete_txt" autocomplete="off"></td>
              

              <td><input type="number" min="0" max="10000" step="0.001" name="cantidad[]" id="cantidad_1" class="form-control changesNo" autocomplete="off" ondrop="return false;" onpaste="return false;"></td>
              

              <td><input type="text" name="medida[]" id="medida_1" class="special text-danger" autocomplete="off" readonly=""></td>

            </tr>
          </tbody>
        </table>
          </div>
        </div>


        <div class='row'>
          <div class='col-md-3'>
            <button class="btn btn-success addmore" type="button"> <i class="fa fa-plus-square"></i> Agregar Mas Productos</button>
          </div>
          <div class='col-md-3'>
            <button class="btn btn-danger delete" type="button"> <i class="fa fa-minus-square"></i> Eliminar Los Productos Checheados</button>
          </div>
        
        
          
          <input type="hidden" name="confirmacion" value="1">
      </div>
        </div>
        
