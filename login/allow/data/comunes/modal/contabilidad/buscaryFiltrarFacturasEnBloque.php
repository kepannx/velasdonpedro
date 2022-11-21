<div id="busquedaFacturaBloque" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" align="center"> <i class="fa fa-search"></i> Búsca y Filtra Facturas En Bloque </h4>
                    <p> <i class="fa fa-info-circle"></i> Si necesitas imprimir las facturas generadas entre una fecha y otra (Ej: 5 marzo de 2017 y 5 de abril de 2017), o imprimir todas las facturas de un cliente en especifico, este es el lugar donde lo haremos!</p>
                  </div>
                  <div class="modal-body">
                    <form name="egreso">
                    <!-- Inicio de formulario-->
                    <div class="col-md-12">
                      <div class="col-md-12">
                        <div class="form-group">
                        <label class="control-label col-md-3">Búscame por</label>
                          <div class="col-md-8">
                           
                              <select id="filtroBusquedaFacturaBloque" class="form-control col-md-12" >
                                <option>Selecciona el Parámetro</option>
                                <option value="nombreClienteBloque">Nombre de Cliente</option>
                                <option value="rangoFechaBloque">Rángo de Fecha</option>
                              </select>
                            
                          </div>
                        </div>
                      </div>
                    </div>
               
        <br>
        <br>
        <br>

        <!-- con nombre cliente-->
          <div class="col-md-12" id="showNombreClienteBloque" style="display: none;">
            <input type="text" id="nombreClienteFacturasBloque" class="inputTextGrande" autocomplete="false"  placeholder="Cómo se llama?" autofocus="" required>
          </div>
        <!-- fin nombre cliente-->

        <!-- rango de fecha -->
          <div class="col-md-12" id="showRangoFechaBloque" style="display: none;">
             <div class="input-daterange input-group" id="rangoFechaFacturaBloque">
                    <input type="text" class="form-control" id="inicioFechaFacturaBloque" value="<?php echo date('m/d/Y', strtotime("-30 days")); ?>" placeholder="Desde la fecha que buscaré" />
                    <span class="input-group-addon bg-info b-0 text-white"> Hasta: </span>
                    <input type="text" class="form-control" id="finalFechaFacturaBloque"  placeholder="Hasta la fecha que buscaré" />
                  </div>
          </div>

        <!-- fin rángo de fecha-->

                  </div>

                  <br>
                  <br>
                  <br>
                  <div class="modal-footer">
                    <button type="button" id="buscarFacturasEnBloque" class="btn btn-success waves-effect waves-light col-md-12" data-dismiss="modal"> <i class="fa fa-search"></i> Encuentrame las Facturas!</button>
                  </div>

                <!-- Fin del formulario -->
                  </form>
                </div>
              </div>
            </div>