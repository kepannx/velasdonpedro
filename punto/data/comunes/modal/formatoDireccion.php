<div class="modal inmodal" id="formatoDireccion" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content animated flipInY">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                                            <h4 class="modal-title">Ingreso de Dirección</h4>
                                            <small class="font-bold">Para lograr una mayor precisión de de la dirección en el mapa necesariamente tienes que ingresarla de forma correcta, este asistente te ayudará a hacerlo  </small>
                                        </div>

                                        <!--Inicio del cuerpo del modal -->
                                        <div class="modal-body">
                                            <div class="col-md-3">
                                                <?php
                                                    $objHtm->selectDireccionTipo('tipo1');
                                                 ?> 
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" id="nomenclatura1" class="form-control" required>
                                            </div>

                                            <div class="col-md-3">
                                                <?php
                                                    $objHtm->selectDireccionTipo('tipo2');
                                                 ?> 
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" id="nomenclatura2" class="form-control" required >
                                            </div>

                                            <hr>
                                            <div class="col-md-12">
                                                <input type="text" id="segundoGrupo" class="form-control" placeholder="Ej: Unidad Residencial Los Alcazares Apto 22-12">
                                            </div>
                                            <hr>
                                        </div>

                                        <!--Fin del cuerpo del modal -->
                                        <div class="modal-footer">
                                            <button type="button" id="pasarDireccion" class="btn btn-success col-md-12"  data-dismiss="modal">Pasa esta dirección</button>
                                        </div>
                                    </div>
                                </div>
                            </div>