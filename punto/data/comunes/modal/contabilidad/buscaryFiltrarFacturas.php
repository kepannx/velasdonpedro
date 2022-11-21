<div id="busquedaFactura" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" align="center">Búsca y Filtra Facturas </h4>
                  </div>
                  <div class="modal-body">
                    <form name="egreso">
                    <!-- Inicio de formulario-->
                    <div class="col-md-12">
                      <div class="col-md-12">
                        <div class="form-group">
                        <label class="control-label col-md-3">Búscame por</label>
                          <div class="col-md-8">
                           
                              <select id="filtroBusquedaFactura" class="form-control col-md-12" >
                                <option>Selecciona el Parámetro</option>
                                <option value="nombreCliente">Nombre de Cliente</option>
                                <option value="nroFactura">Número Factura</option>
                                <option value="rangoFecha">Rángo de Fecha</option>
                              </select>
                            
                          </div>
                        </div>
                      </div>
                    </div>
               
        <br>
        <br>
        <br>

        <!-- con nombre cliente-->
          <div class="col-md-12" id="showNombreCliente" style="display: none;">
            <input type="text" id="nombreClienteFacturas" class="inputTextGrande" autocomplete="false"  placeholder="Cómo se llama?" autofocus="" required>
          </div>
        <!-- fin nombre cliente-->


        <!-- con nro factura -->
          <div class="col-md-12" id="showNroFactura" style="display: none;">
              <input type="number" id="nroFactura" class="inputTextGrande"  placeholder="Dame el número" min="1" max="100000000" required>
          </div>

        <!-- fin número de factura-->

        <!-- rango de fecha -->
          <div class="col-md-12" id="showRangoFecha" style="display: none;">
             <div class="input-daterange input-group" id="rangoFechaFactura">
                    <input type="text" class="form-control" id="inicioFechaFactura" value="<?php echo date('m/d/Y', strtotime("-30 days")); ?>" placeholder="Desde la fecha que buscaré" />
                    <span class="input-group-addon bg-info b-0 text-white"> Hasta: </span>
                    <input type="text" class="form-control" id="finalFechaFactura"  placeholder="Hasta la fecha que buscaré" />
                  </div>
          </div>

        <!-- fin rángo de fecha-->

                  </div>

                  <br>
                  <br>
                  <br>
                  <div class="modal-footer">
                    <button type="button" id="buscarFacturas" class="btn btn-success waves-effect waves-light col-md-12" data-dismiss="modal"> <i class="fa fa-search"></i> Encuentrame las Facturas!</button>
                  </div>

                <!-- Fin del formulario -->
                  </form>
                </div>
              </div>
            </div>